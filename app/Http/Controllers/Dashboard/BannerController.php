<?php

namespace App\Http\Controllers\Dashboard;

use App\DataObjects\DataObjectCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Models\Lang;
use App\ViewModels\Banner\BannerViewModel;
use App\ViewModels\Banner\IndexBannerViewModel;
use App\ViewModels\PaginationViewModel;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
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
        $query = Banner::with('translations.lang')->orderBy('updated_at', 'desc');

        $totalCount = $query->count();
        $skip       = $limit * ($page - 1);
        $items      = $query->skip($skip)->take($limit)->get();

        $banners = new DataObjectCollection($items, $totalCount, $limit, $page);

        return (new PaginationViewModel($banners, IndexBannerViewModel::class))->toView('admin.banners.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = Lang::where('is_published', true)->get();
        return view('admin.banners.create', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BannerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        try {
            DB::beginTransaction();
            $file = $request->file('file');

            $type = $file->guessExtension();

            // Store the file in a directory: 'public/banners/'
            if (in_array($type, ['mp4', 'mov', 'avi'])) {
                // video
                $generatedName = 'banners-file_' . time() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('banners', $generatedName, 'public');
                $file_type = $file->getClientMimeType();
                $type = 'video';
            } else {
                // image
                $generatedName = 'banners-file_' . time() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('banners', $generatedName, 'public');
                $type = 'image';
            }

            $banner = Banner::create([
                'file' => $filePath,
                'file_type' => $file_type ?? null,
                'type' => $type,
                'is_published' => $request->input('is_published') == 'on' ? true : false,
            ]);

            $langs = Lang::where('is_published', true)->get();

            foreach ($langs as $lang) {
                if ($request->input('title_' . $lang->code)) {
                    $banner->translations()->create([
                        'lang_id' => $lang->id,
                        'column_name' => 'title',
                        'content' => $request->input('title_' . $lang->code),
                    ]);
                }
            }

            toastr('Created successfully');

            DB::commit();
            return redirect()->route('dash.banners.index');
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
    public function edit(Banner $banner)
    {
        $langs = Lang::where('is_published', true)->get();

        $banner =  Banner::with('translations.lang')->find($banner->id);
        $banner = new BannerViewModel($banner);
        return view('admin.banners.edit', compact('langs', 'banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, Banner $banner)
    {
        try {
            DB::beginTransaction();

            $filePath = $banner->file;
            $type = $banner->type;
            $file_type = $banner->file_type;

            if ($request->hasFile('file')) {
                if (Storage::exists('/public/' . $banner->getRawOriginal('file'))) {
                    Storage::delete('/public/' . $banner->getRawOriginal('file'));
                }
                // Store the file in a directory: 'public/banners/'


                $file = $request->file('file');

                $type = $file->guessExtension();

                // Store the file in a directory: 'public/banners/'
                if (in_array($type, ['mp4', 'mov', 'avi'])) {
                    // video
                    $generatedName = 'banners-file_' . time() . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('banners', $generatedName, 'public');
                    $file_type = $file->getClientMimeType();
                    $type = 'video';
                } else {
                    // image
                    $generatedName = 'banners-file_' . time() . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('banners', $generatedName, 'public');
                    $type = 'image';
                }
            }


            $banner->update([
                'file' => $filePath,
                'file_type' => $file_type ?? null,
                'type' => $type,
                'is_published' => $request->input('is_published') == 'on' ? true : false,
            ]);
            $banner->refresh();

            $langs = Lang::where('is_published', true)->get();

            foreach ($langs as $lang) {
                if ($request->input('title_' . $lang->code)) {
                    $banner->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'title',
                        ],
                        [
                            'content' => $request->input('title_' . $lang->code),
                        ]
                    );
                }
            }

            toastr('Updated successfully');

            DB::commit();
            return redirect()->route('dash.banners.index');
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
    public function destroy(Banner $banner)
    {
        try {
            DB::beginTransaction();

            if (Storage::exists('/public/' . $banner->getRawOriginal('file'))) {
                Storage::delete('/public/' . $banner->getRawOriginal('file'));
            }

            // delete banner's translations
            $banner->translations()->delete();
            $banner->delete();

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
