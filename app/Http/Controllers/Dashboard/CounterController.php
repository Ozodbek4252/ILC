<?php

namespace App\Http\Controllers\Dashboard;

use App\DataObjects\DataObjectCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\CounterRequest;
use App\Models\Counter;
use App\Models\Icon;
use App\Models\Lang;
use App\ViewModels\Counter\CounterViewModel;
use App\ViewModels\Counter\IndexCounterViewModel;
use App\ViewModels\PaginationViewModel;
use Exception;
use Illuminate\Support\Facades\DB;

class CounterController extends Controller
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
        $query = Counter::with('translations.lang')->orderBy('updated_at', 'desc');

        $totalCount = $query->count();
        $skip       = $limit * ($page - 1);
        $items      = $query->skip($skip)->take($limit)->get();

        $counters = new DataObjectCollection($items, $totalCount, $limit, $page);

        return (new PaginationViewModel($counters, IndexCounterViewModel::class))->toView('admin.counters.index');
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
        return view('admin.counters.create', compact('langs', 'icons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CounterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CounterRequest $request)
    {
        try {
            DB::beginTransaction();

            $counter = Counter::create([
                'icon_id' => $request->input('icon_id'),
                'number' => $request->input('number'),
            ]);

            $langs = Lang::where('is_published', true)->get();

            foreach ($langs as $lang) {
                if ($request->input('text_' . $lang->code)) {
                    $counter->translations()->create([
                        'lang_id' => $lang->id,
                        'column_name' => 'text',
                        'content' => $request->input('text_' . $lang->code),
                    ]);
                }
            }

            toastr('Created successfully');

            DB::commit();
            return redirect()->route('dash.counters.index');
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
    public function edit(Counter $counter)
    {
        $langs = Lang::where('is_published', true)->get();
        $icons = Icon::all();

        $counter =  Counter::with('translations.lang')->find($counter->id);
        $counter = new CounterViewModel($counter);
        return view('admin.counters.edit', compact('langs', 'counter', 'icons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CounterRequest $request, Counter $counter)
    {
        try {
            DB::beginTransaction();

            $counter->update([
                'icon_id' => $request->input('icon_id'),
                'number' => $request->input('number')
            ]);
            $counter->refresh();

            $langs = Lang::where('is_published', true)->get();

            foreach ($langs as $lang) {
                if ($request->input('text_' . $lang->code)) {
                    $counter->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'text',
                        ],
                        [
                            'content' => $request->input('text_' . $lang->code),
                        ]
                    );
                }

                $translation = $counter->translations
                    ->where('lang_id', $lang->id)
                    ->where('column_name', 'text')
                    ->first();
                if ($translation && !$request->input('text_' . $lang->code)) {
                    $translation->delete();
                }
            }

            toastr('Updated successfully');

            DB::commit();
            return redirect()->route('dash.counters.index');
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
    public function destroy(Counter $counter)
    {
        try {
            DB::beginTransaction();

            // delete counter's translations
            $counter->translations()->delete();
            $counter->delete();

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
