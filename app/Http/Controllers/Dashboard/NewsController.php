<?php

namespace App\Http\Controllers\Dashboard;

use App\DataObjects\DataObjectCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\Lang;
use App\Models\News;
use App\ViewModels\News\IndexNewsViewModel;
use App\ViewModels\News\NewsViewModel;
use App\ViewModels\PaginationViewModel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $page
     * @param int $limit
     * @return \Illuminate\Http\Response
     */
    public function index(int $page = 1, int $limit = 15)
    {
        $query = News::with('translations.lang')->orderBy('updated_at', 'desc');

        $totalCount = $query->count();
        $skip       = $limit * ($page - 1);
        $items      = $query->skip($skip)->take($limit)->get();

        $news = new DataObjectCollection($items, $totalCount, $limit, $page);

        return (new PaginationViewModel($news, IndexNewsViewModel::class))->toView('admin.news.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = Lang::where('is_published', true)->get();
        return view('admin.news.create', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\NewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        try {
            DB::beginTransaction();

            $image = $request->file('image');

            // Store the image in a directory: 'public/news/'
            $generatedName = 'news-image_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('news', $generatedName, 'public');


            $news = News::create([
                'image' => $imagePath,
                'is_published' => $request->input('is_published') == 'on' ? true : false,
            ]);

            $langs = Lang::where('is_published', true)->get();

            foreach ($langs as $lang) {
                if ($request->input('title_' . $lang->code)) {
                    $news->translations()->create([
                        'lang_id' => $lang->id,
                        'column_name' => 'title',
                        'content' => $request->input('title_' . $lang->code),
                    ]);
                }
                if ($request->input('text_' . $lang->code)) {
                    $news->translations()->create([
                        'lang_id' => $lang->id,
                        'column_name' => 'text',
                        'content' => $request->input('text_' . $lang->code),
                    ]);
                }
            }

            toastr('Created successfully');

            DB::commit();
            return redirect()->route('dash.news.index');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors([
                'error' => 'Error. Can\'t store',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $langs = Lang::where('is_published', true)->get();

        $news =  News::with('translations.lang')->find($news->id);
        $news = new NewsViewModel($news);
        return view('admin.news.edit', compact('langs', 'news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, News $news)
    {
        try {
            DB::beginTransaction();

            $imagePath = $news->getRawOriginal('image');

            if ($request->hasFile('image')) {
                if (Storage::exists('/public/' . $imagePath)) {
                    Storage::delete('/public/' . $imagePath);
                }
                // Store the image in a directory: 'public/news/'
                $generatedName = 'news-image_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $imagePath = $request->file('image')->storeAs('news', $generatedName, 'public');
            }

            $news->update([
                'image' => $imagePath,
                'is_published' => $request->input('is_published') == 'on' ? true : false,
            ]);
            $news->refresh();

            $langs = Lang::where('is_published', true)->get();

            foreach ($langs as $lang) {
                if ($request->input('title_' . $lang->code)) {
                    $news->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'title',
                        ],
                        [
                            'content' => $request->input('title_' . $lang->code),
                        ]
                    );
                }
                $translation = $news->translations
                    ->where('lang_id', $lang->id)
                    ->where('column_name', 'title')
                    ->first();

                if ($translation && !$request->input('title_' . $lang->code)) {
                    $translation->delete();
                }

                if ($request->input('text_' . $lang->code)) {
                    $news->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'text',
                        ],
                        [
                            'content' => $request->input('text_' . $lang->code),
                        ]
                    );
                }
                $translation = $news->translations
                    ->where('lang_id', $lang->id)
                    ->where('column_name', 'text')
                    ->first();

                if ($translation && !$request->input('text_' . $lang->code)) {
                    $translation->delete();
                }
            }

            toastr('Updated successfully');

            DB::commit();
            return redirect()->route('dash.news.index');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors([
                'error' => 'Error. Can\'t update',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        try {
            DB::beginTransaction();

            if (Storage::exists('/public/' . $news->getRawOriginal('image'))) {
                Storage::delete('/public/' . $news->getRawOriginal('image'));
            }

            // delete news's translations
            $news->translations()->delete();
            $news->delete();

            toastr('Deleted successfully');

            DB::commit();
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors([
                'error' => 'Error. Can\'t delete',
            ]);
        }
    }
}
