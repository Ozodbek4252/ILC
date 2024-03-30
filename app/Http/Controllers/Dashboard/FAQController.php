<?php

namespace App\Http\Controllers\Dashboard;

use App\DataObjects\DataObjectCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\FAQRequest;
use App\Models\FAQ;
use App\Models\Lang;
use App\ViewModels\FAQ\FAQViewModel;
use App\ViewModels\FAQ\IndexFAQViewModel;
use App\ViewModels\PaginationViewModel;
use Exception;
use Illuminate\Support\Facades\DB;

class FAQController extends Controller
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
        $query = FAQ::with('translations.lang')->orderBy('updated_at', 'desc');

        $totalCount = $query->count();
        $skip       = $limit * ($page - 1);
        $items      = $query->skip($skip)->take($limit)->get();

        $faqs = new DataObjectCollection($items, $totalCount, $limit, $page);

        return (new PaginationViewModel($faqs, IndexFAQViewModel::class))->toView('admin.faqs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = Lang::where('is_published', true)->get();
        return view('admin.faqs.create', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\FAQRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FAQRequest $request)
    {
        try {
            DB::beginTransaction();

            $faq = FAQ::create();
            $langs = Lang::where('is_published', true)->get();
            foreach ($langs as $lang) {
                if ($request->input('question_' . $lang->code)) {
                    $faq->translations()->create([
                        'lang_id' => $lang->id,
                        'column_name' => 'question',
                        'content' => $request->input('question_' . $lang->code),
                    ]);
                }

                if ($request->input('answer_' . $lang->code)) {
                    $faq->translations()->create([
                        'lang_id' => $lang->id,
                        'column_name' => 'answer',
                        'content' => $request->input('answer_' . $lang->code),
                    ]);
                }
            }

            toastr('Created successfully');

            DB::commit();
            return redirect()->route('dash.faqs.index');
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
    public function edit(FAQ $faq)
    {
        $langs = Lang::where('is_published', true)->get();

        $faq =  FAQ::with('translations.lang')->find($faq->id);
        $faq = new FAQViewModel($faq);
        return view('admin.faqs.edit', compact('langs', 'faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FAQRequest $request, FAQ $faq)
    {
        try {
            DB::beginTransaction();

            $faq->update();
            $faq->refresh();

            $langs = Lang::where('is_published', true)->get();
            foreach ($langs as $lang) {
                if ($request->input('question_' . $lang->code)) {
                    $faq->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'question',
                        ],
                        [
                            'content' => $request->input('question_' . $lang->code),
                        ]
                    );
                }
                if ($request->input('answer_' . $lang->code)) {
                    $faq->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'answer',
                        ],
                        [
                            'content' => $request->input('answer_' . $lang->code),
                        ]
                    );
                }
            }

            toastr('Updated successfully');

            DB::commit();
            return redirect()->route('dash.faqs.index');
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
    public function destroy(FAQ $faq)
    {
        try {
            DB::beginTransaction();

            // delete faq's translations
            $faq->translations()->delete();
            $faq->delete();

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
