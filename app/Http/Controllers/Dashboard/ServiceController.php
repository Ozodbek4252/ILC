<?php

namespace App\Http\Controllers\Dashboard;

use App\DataObjects\DataObjectCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Icon;
use App\Models\Lang;
use App\ViewModels\PaginationViewModel;
use App\Models\Service;
use App\ViewModels\Service\IndexServiceViewModel;
use App\ViewModels\Service\ServiceViewModel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
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
        $query = Service::with('translations.lang')->orderBy('updated_at', 'desc');

        $totalCount = $query->count();
        $skip       = $limit * ($page - 1);
        $items      = $query->skip($skip)->take($limit)->get();

        $services = new DataObjectCollection($items, $totalCount, $limit, $page);

        return (new PaginationViewModel($services, IndexServiceViewModel::class))->toView('admin.services.index');
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
        return view('admin.services.create', compact('langs', 'icons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        try {
            DB::beginTransaction();

            $image = $request->file('image');

            // Store the image in a directory: 'public/services/'
            $generatedName = 'services-image_' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('services', $generatedName, 'public');


            $service = Service::create([
                'icon_id' => $request->input('icon_id'),
                'link' => $request->input('link'),
                'image' => $imagePath,
            ]);

            $langs = Lang::where('is_published', true)->get();

            foreach ($langs as $lang) {
                if ($request->input('name_' . $lang->code)) {
                    $service->translations()->create([
                        'lang_id' => $lang->id,
                        'column_name' => 'name',
                        'content' => $request->input('name_' . $lang->code),
                    ]);
                }
                if ($request->input('description_' . $lang->code)) {
                    $service->translations()->create([
                        'lang_id' => $lang->id,
                        'column_name' => 'description',
                        'content' => $request->input('description_' . $lang->code),
                    ]);
                }
            }

            toastr('Created successfully');

            DB::commit();
            return redirect()->route('dash.services.index');
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
    public function edit(Service $service)
    {
        $langs = Lang::where('is_published', true)->get();
        $icons = Icon::all();

        $service =  Service::with('translations.lang')->find($service->id);
        $service = new ServiceViewModel($service);
        return view('admin.services.edit', compact('langs', 'service', 'icons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, Service $service)
    {
        try {
            DB::beginTransaction();

            $imagePath = $service->image;

            if ($request->hasFile('image')) {
                if (Storage::exists('/public/' . $imagePath)) {
                    Storage::delete('/public/' . $imagePath);
                }
                // Store the image in a directory: 'public/services/'
                $generatedName = 'services-image_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $imagePath = $request->file('image')->storeAs('services', $generatedName, 'public');
            }

            $service->update([
                'icon_id' => $request->input('icon_id'),
                'link' => $request->input('link'),
                'image' => $imagePath,
            ]);
            $service->refresh();

            $langs = Lang::where('is_published', true)->get();

            foreach ($langs as $lang) {
                if ($request->input('name_' . $lang->code)) {
                    $service->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'name',
                        ],
                        [
                            'content' => $request->input('name_' . $lang->code),
                        ]
                    );
                }

                $translation = $service->translations
                    ->where('lang_id', $lang->id)
                    ->where('column_name', 'name')
                    ->first();
                if ($translation && !$request->input('name_' . $lang->code)) {
                    $translation->delete();
                }

                if ($request->input('description_' . $lang->code)) {
                    $service->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'description',
                        ],
                        [
                            'content' => $request->input('description_' . $lang->code),
                        ]
                    );
                }

                $translation = $service->translations
                    ->where('lang_id', $lang->id)
                    ->where('column_name', 'description')
                    ->first();
                if ($translation && !$request->input('description_' . $lang->code)) {
                    $translation->delete();
                }
            }

            toastr('Updated successfully');

            DB::commit();
            return redirect()->route('dash.services.index');
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
    public function destroy(Service $service)
    {
        try {
            DB::beginTransaction();

            if (Storage::exists('/public/' . $service->image)) {
                Storage::delete('/public/' . $service->image);
            }

            // delete service's translations
            $service->translations()->delete();
            $service->delete();

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
