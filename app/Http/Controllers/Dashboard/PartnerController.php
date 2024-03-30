<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerRequest;
use App\Models\Partner;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $page
     * @param int $limit
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PartnerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerRequest $request)
    {
        try {
            DB::beginTransaction();

            // Store the image in a directory: 'public/partners/'
            $generatedName = 'partners-image_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('partners', $generatedName, 'public');

            Partner::create([
                'image' => $imagePath,
                'name' => $request->input('name'),
            ]);

            toastr('Created successfully');

            DB::commit();
            return redirect()->route('dash.partners.index');
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
    public function edit(Partner $partner)
    {

        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PartnerRequest $request, Partner $partner)
    {
        try {
            DB::beginTransaction();

            $imagePath = $partner->image;

            if ($request->hasFile('image')) {
                if (Storage::exists('/public/' . $partner->image)) {
                    Storage::delete('/public/' . $partner->image);
                }
                // Store the image in a directory: 'public/partners/'
                $generatedName = 'partners-image_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $imagePath = $request->file('image')->storeAs('partners', $generatedName, 'public');
            }

            $partner->update([
                'image' => $imagePath,
                'name' => $request->input('name'),
            ]);

            toastr('Updated successfully');

            DB::commit();
            return redirect()->route('dash.partners.index');
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
    public function destroy(Partner $partner)
    {
        try {
            DB::beginTransaction();

            if (Storage::exists('/public/' . $partner->image)) {
                Storage::delete('/public/' . $partner->image);
            }

            $partner->delete();

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
