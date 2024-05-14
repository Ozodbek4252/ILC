<?php

namespace App\Http\Controllers\Dashboard;

use App\DataObjects\DataObjectCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\TariffRequest;
use App\Models\Icon;
use App\Models\Lang;
use App\Models\Tariff;
use App\ViewModels\PaginationViewModel;
use App\ViewModels\Tariff\IndexTariffViewModel;
use App\ViewModels\Tariff\TariffViewModel;
use Exception;
use Illuminate\Support\Facades\DB;

class TariffController extends Controller
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
        $query = Tariff::with('translations.lang')->orderBy('updated_at', 'desc');

        $totalCount = $query->count();
        $skip       = $limit * ($page - 1);
        $items      = $query->skip($skip)->take($limit)->get();

        $tariffs = new DataObjectCollection($items, $totalCount, $limit, $page);

        return (new PaginationViewModel($tariffs, IndexTariffViewModel::class))->toView('admin.tariffs.index');
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
        return view('admin.tariffs.create', compact('langs', 'icons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TariffRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TariffRequest $request)
    {
        try {
            DB::beginTransaction();

            $tariff = Tariff::create([
                'icon_id' => $request->input('icon_id'),
                'price' => $request->input('price'),
                'link' => $request->input('link'),
            ]);

            $langs = Lang::where('is_published', true)->get();

            foreach ($langs as $lang) {
                if ($request->input('name_' . $lang->code)) {
                    $tariff->translations()->create([
                        'lang_id' => $lang->id,
                        'column_name' => 'name',
                        'content' => $request->input('name_' . $lang->code),
                    ]);
                }
                if ($request->input('delivery_time_' . $lang->code)) {
                    $tariff->translations()->create([
                        'lang_id' => $lang->id,
                        'column_name' => 'delivery_time',
                        'content' => $request->input('delivery_time_' . $lang->code),
                    ]);
                }
                if ($request->input('unit_' . $lang->code)) {
                    $tariff->translations()->create([
                        'lang_id' => $lang->id,
                        'column_name' => 'unit',
                        'content' => $request->input('unit_' . $lang->code),
                    ]);
                }
                if ($request->input('schedule_' . $lang->code)) {
                    $tariff->translations()->create([
                        'lang_id' => $lang->id,
                        'column_name' => 'schedule',
                        'content' => $request->input('schedule_' . $lang->code),
                    ]);
                }
                if ($request->input('destination_' . $lang->code)) {
                    $tariff->translations()->create([
                        'lang_id' => $lang->id,
                        'column_name' => 'destination',
                        'content' => $request->input('destination_' . $lang->code),
                    ]);
                }
            }

            toastr('Created successfully');

            DB::commit();
            return redirect()->route('dash.tariffs.index');
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
    public function edit(Tariff $tariff)
    {
        $langs = Lang::where('is_published', true)->get();
        $icons = Icon::all();

        $tariff =  Tariff::with('translations.lang')->find($tariff->id);
        $tariff = new TariffViewModel($tariff);
        return view('admin.tariffs.edit', compact('langs', 'tariff', 'icons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TariffRequest $request, Tariff $tariff)
    {
        try {
            DB::beginTransaction();

            $tariff->update([
                'icon_id' => $request->input('icon_id'),
                'price' => $request->input('price'),
                'link' => $request->input('link')
            ]);
            $tariff->refresh();

            $langs = Lang::where('is_published', true)->get();

            foreach ($langs as $lang) {
                if ($request->input('name_' . $lang->code)) {
                    $tariff->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'name',
                        ],
                        [
                            'content' => $request->input('name_' . $lang->code),
                        ]
                    );
                }

                $translation = $tariff->translations
                    ->where('lang_id', $lang->id)
                    ->where('column_name', 'name')
                    ->first();
                if ($translation && !$request->input('name_' . $lang->code)) {
                    $translation->delete();
                }

                if ($request->input('schedule_' . $lang->code)) {
                    $tariff->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'schedule',
                        ],
                        [
                            'content' => $request->input('schedule_' . $lang->code),
                        ]
                    );
                }

                $translation = $tariff->translations
                    ->where('lang_id', $lang->id)
                    ->where('column_name', 'schedule')
                    ->first();
                if ($translation && !$request->input('schedule_' . $lang->code)) {
                    $translation->delete();
                }

                if ($request->input('delivery_time_' . $lang->code)) {
                    $tariff->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'delivery_time',
                        ],
                        [
                            'content' => $request->input('delivery_time_' . $lang->code),
                        ]
                    );
                }

                $translation = $tariff->translations
                    ->where('lang_id', $lang->id)
                    ->where('column_name', 'delivery_time')
                    ->first();
                if ($translation && !$request->input('delivery_time_' . $lang->code)) {
                    $translation->delete();
                }

                if ($request->input('unit_' . $lang->code)) {
                    $tariff->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'unit',
                        ],
                        [
                            'content' => $request->input('unit_' . $lang->code),
                        ]
                    );
                }

                $translation = $tariff->translations
                    ->where('lang_id', $lang->id)
                    ->where('column_name', 'unit')
                    ->first();
                if ($translation && !$request->input('unit_' . $lang->code)) {
                    $translation->delete();
                }

                if ($request->input('destination_' . $lang->code)) {
                    $tariff->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'destination',
                        ],
                        [
                            'content' => $request->input('destination_' . $lang->code),
                        ]
                    );
                }

                $translation = $tariff->translations
                    ->where('lang_id', $lang->id)
                    ->where('column_name', 'destination')
                    ->first();
                if ($translation && !$request->input('destination_' . $lang->code)) {
                    $translation->delete();
                }
            }

            toastr('Updated successfully');

            DB::commit();
            return redirect()->route('dash.tariffs.index');
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
    public function destroy(Tariff $tariff)
    {
        try {
            DB::beginTransaction();

            // delete tariff's translations
            $tariff->translations()->delete();
            $tariff->delete();

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
