<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\IconRequest;
use App\Models\Icon;
use Exception;

class IconController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $icons = Icon::orderBy('updated_at', 'desc')->paginate(20);

        return view('admin.icons.index', compact('icons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IconRequest $request)
    {
        try {
            $icon = $request->file('icon');

            // Store the icon in a directory: 'public/icons/'
            $generatedName = 'icons-icon_' . time() . '.' . $icon->getClientOriginalExtension();
            $iconPath = $icon->storeAs('icons', $generatedName, 'public');

            Icon::create([
                'icon' => $iconPath,
                'name' => $request->name,
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
    public function update(IconRequest $request, Icon $icon)
    {
        try {
            $iconPath = $icon->getRawOriginal('icon');

            if ($request->hasFile('icon')) {
                if (Storage::exists('/public/' . $iconPath)) {
                    Storage::delete('/public/' . $iconPath);
                }

                // Store the icon in a directory: 'public/icons/'
                $generatedName = 'icons-icon_' . time() . '.' . $request->file('icon')->getClientOriginalExtension();
                $iconPath = $request->file('icon')->storeAs('icons', $generatedName, 'public');
            }

            $icon->update([
                'icon' => $iconPath,
                'name' => $request->name,
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
    public function destroy(Icon $icon)
    {
        try {
            if (Storage::exists('/public/' . $icon->getRawOriginal('icon'))) {
                Storage::delete('/public/' . $icon->getRawOriginal('icon'));
            }

            $icon->delete();

            toastr('Deleted successfully');

            return redirect()->back();
        } catch (Exception $e) {
            return back()->withErrors(['Error' => 'Error. Can\'t delete']);
        }
    }
}
