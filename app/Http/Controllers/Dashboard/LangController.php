<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LangRequest;
use App\Models\Lang;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class LangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $langs = Lang::paginate(20);

        return view('admin.langs.index', compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LangRequest $request)
    {
        try {
            // generate name for the icon
            $generatedName = 'icon_' . time() . '.' . $request->file('icon')->getClientOriginalExtension();

            // Move the uploaded file to the public/assets/images/flags directory, not in storage
            $request->file('icon')->move(public_path('assets/images/flags'), $generatedName);
            $iconPath = 'assets/images/flags/' . $generatedName;

            Lang::create([
                'code' => $request->code,
                'name' => $request->name,
                'icon' => $iconPath,
                'is_published' => $request->is_published == 'on' ? true : false,
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
    public function update(LangRequest $request, Lang $lang)
    {
        try {
            $iconPath = $lang->icon;

            if ($request->hasFile('icon')) {
                if (File::exists($lang->icon)) {
                    File::delete($lang->icon);
                }

                // generate name for the icon
                $generatedName = 'icon_' . time() . '.' . $request->file('icon')->getClientOriginalExtension();

                // Move the uploaded file to the public/assets/images/flags directory, not in storage
                $request->file('icon')->move(public_path('assets/images/flags'), $generatedName);
                $iconPath = 'assets/images/flags/' . $generatedName;
            }

            $lang->update([
                'code' => $request->code,
                'name' => $request->name,
                'icon' => $iconPath,
                'is_published' => $request->is_published == 'on' ? true : false,
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
    public function destroy(Lang $lang)
    {
        try {
            if (File::exists($lang->icon)) {
                File::delete($lang->icon);
            }

            $lang->delete();

            toastr('Deleted successfully');

            return redirect()->back();
        } catch (Exception $e) {
            return back()->withErrors(['Error' => 'Error. Can\'t delete']);
        }
    }

    /**
     * Change the language
     */
    public function changeLang(Lang $lang)
    {
        session()->put('locale', $lang->code);
        App::setLocale($lang->code);

        return redirect()->back();
    }
}
