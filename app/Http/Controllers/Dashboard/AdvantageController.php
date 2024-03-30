<?php

namespace App\Http\Controllers\Dashboard;

use App\DataObjects\DataObjectCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdvantageRequest;
use App\ViewModels\Advantage\AdvantageViewModel;
use App\ViewModels\Advantage\IndexAdvantageViewModel;
use App\ViewModels\PaginationViewModel;
use Illuminate\Support\Facades\DB;
use App\Models\Advantage;
use App\Models\Icon;
use App\Models\Lang;
use Exception;

class AdvantageController extends Controller
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
        $query = Advantage::with('translations.lang')->orderBy('updated_at', 'desc');

        $totalCount = $query->count();
        $skip       = $limit * ($page - 1);
        $items      = $query->skip($skip)->take($limit)->get();

        $advantages = new DataObjectCollection($items, $totalCount, $limit, $page);

        return (new PaginationViewModel($advantages, IndexAdvantageViewModel::class))->toView('admin.advantages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = Lang::where('is_published', true)->get();
        $icons = Icon::all();
        return view('admin.advantages.create', compact('langs', 'icons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AdvantageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvantageRequest $request)
    {
        try {
            DB::beginTransaction();


            $advantage = Advantage::create([
                'icon_id' => $request->input('icon_id'),
            ]);

            $langs = Lang::where('is_published', true)->get();

            foreach ($langs as $lang) {
                if ($request->input('title_' . $lang->code)) {
                    $advantage->translations()->create([
                        'lang_id' => $lang->id,
                        'column_name' => 'title',
                        'content' => $request->input('title_' . $lang->code),
                    ]);
                }
                if ($request->input('description_' . $lang->code)) {
                    $advantage->translations()->create([
                        'lang_id' => $lang->id,
                        'column_name' => 'description',
                        'content' => $request->input('description_' . $lang->code),
                    ]);
                }
            }

            toastr('Created successfully');

            DB::commit();
            return redirect()->route('dash.advantages.index');
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
    public function edit(Advantage $advantage)
    {
        $langs = Lang::where('is_published', true)->get();
        $icons = Icon::all();

        $advantage =  Advantage::with('translations.lang')->find($advantage->id);
        $advantage = new AdvantageViewModel($advantage);
        return view('admin.advantages.edit', compact('langs', 'advantage', 'icons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdvantageRequest $request, Advantage $advantage)
    {
        try {
            DB::beginTransaction();

            $advantage->update([
                'icon_id' => $request->input('icon_id')
            ]);
            $advantage->refresh();

            $langs = Lang::where('is_published', true)->get();

            foreach ($langs as $lang) {
                if ($request->input('title_' . $lang->code)) {
                    $advantage->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'title',
                        ],
                        [
                            'content' => $request->input('title_' . $lang->code),
                        ]
                    );
                }

                $translation = $advantage->translations
                    ->where('lang_id', $lang->id)
                    ->where('column_name', 'title')
                    ->first();
                if ($translation && !$request->input('title_' . $lang->code)) {
                    $translation->delete();
                }

                if ($request->input('description_' . $lang->code)) {
                    $advantage->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'description',
                        ],
                        [
                            'content' => $request->input('description_' . $lang->code),
                        ]
                    );
                }

                $translation = $advantage->translations
                    ->where('lang_id', $lang->id)
                    ->where('column_name', 'description')
                    ->first();
                if ($translation && !$request->input('description_' . $lang->code)) {
                    $translation->delete();
                }
            }

            toastr('Updated successfully');

            DB::commit();
            return redirect()->route('dash.advantages.index');
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
    public function destroy(Advantage $advantage)
    {
        try {
            DB::beginTransaction();

            // delete advantage's translations
            $advantage->translations()->delete();
            $advantage->delete();

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
