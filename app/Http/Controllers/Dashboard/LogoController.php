<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\Logo;
use Illuminate\Http\Request;
use Exception;

class LogoController extends Controller
{
    public function index()
    {
        $logo = Logo::first();
        return view('admin.logo.index', compact('logo'));
    }

    public function update(Request $request, Logo $logo)
    {
        try {
            $request->validate([
                'main_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'small_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $mainLogoPath = $logo->main_logo;
            if ($request->hasFile('main_logo')) {
                if (File::exists($logo->main_logo)) {
                    File::delete($logo->main_logo);
                }

                // generate name for the icon
                $generatedName = 'main_logo_' . time() . '.' . $request->file('main_logo')->getClientOriginalExtension();

                // Move the uploaded file to the public/assets/images/logo directory, not in storage
                $request->file('main_logo')->move(public_path('assets/images/logo'), $generatedName);
                $mainLogoPath = 'assets/images/logo/' . $generatedName;
            }

            $smallLogoPath = $logo->small_logo;
            if ($request->hasFile('small_logo')) {
                if (File::exists($logo->small_logo)) {
                    File::delete($logo->small_logo);
                }

                // generate name for the icon
                $generatedName = 'small_logo_' . time() . '.' . $request->file('small_logo')->getClientOriginalExtension();

                // Move the uploaded file to the public/assets/images/logo directory, not in storage
                $request->file('small_logo')->move(public_path('assets/images/logo'), $generatedName);
                $smallLogoPath = 'assets/images/logo/' . $generatedName;
            }

            $logo->update([
                'main_logo' => $mainLogoPath,
                'small_logo' => $smallLogoPath,
            ]);

            toastr('Updated successfully');

            return redirect()->back();
        } catch (Exception $e) {
            return back()->withErrors([
                'error' => 'Error. Can\'t update',
            ]);
        }
    }
}
