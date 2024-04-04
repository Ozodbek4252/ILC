<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Exception;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index()
    {
        $seo = Seo::first();

        return view('admin.seo.index', compact('seo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Request $request, Seo $seo)
    {
        try {
            $request->validate([
                'keywords' => 'required|string',
                'description' => 'required|string',
            ]);

            $seo->update([
                'keywords' => $request->keywords,
                'description' => $request->description,
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
