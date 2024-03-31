<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialRequest;
use App\Models\Icon;
use App\Models\Social;
use Exception;

class SocialController extends Controller
{

    public function index()
    {
        $socials = Social::orderBy('updated_at', 'desc')->paginate(10);
        $icons = Icon::all();
        return view('admin.socials.index', compact('socials', 'icons'));
    }

    public function create()
    {
        return view('admin.socials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialRequest $request)
    {
        try {
            Social::create([
                'icon_id' => $request->icon_id,
                'name' => $request->name,
                'link' => $request->link,
            ]);

            toastr('Created successfully');

            return redirect()->back();
        } catch (Exception $e) {
            return back()->withErrors([
                'error' => 'Error. Can\'t store',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SocialRequest $request, Social $social)
    {
        try {
            $social->update([
                'icon_id' => $request->icon_id,
                'name' => $request->name,
                'link' => $request->link,
            ]);

            toastr('Updated successfully');

            return redirect()->back();
        } catch (Exception $e) {
            return back()->withErrors([
                'error' => 'Error. Can\'t update',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Social $social)
    {
        try {
            $social->delete();

            toastr('Deleted successfully');

            return redirect()->back();
        } catch (Exception $e) {
            return back()->withErrors(['Error' => 'Error. Can\'t delete']);
        }
    }
}
