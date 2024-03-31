<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Models\About;
use App\Models\Lang;
use App\ViewModels\About\AboutViewModel;
use App\ViewModels\About\IndexAboutViewModel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::with('translations.lang')->first();
        $about =  About::with('translations.lang')->find($about->id);
        $about = new IndexAboutViewModel($about);
        return view('admin.about.index', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        $langs = Lang::where('is_published', true)->get();

        $about =  About::with('translations.lang')->find($about->id);
        $about = new AboutViewModel($about);
        return view('admin.about.edit', compact('langs', 'about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutRequest $request, About $about)
    {
        try {
            DB::beginTransaction();

            $backgroundImagePath = $about->background_image;

            if ($request->hasFile('background_image')) {
                if (Storage::exists('/public/' . $backgroundImagePath)) {
                    Storage::delete('/public/' . $backgroundImagePath);
                }

                $background_image = $request->file('background_image');

                // Store the background_image in a directory: 'public/about/'
                $generatedName = 'icons-background_image_' . time() . '.' . $background_image->getClientOriginalExtension();
                $backgroundImagePath = $background_image->storeAs('about', $generatedName, 'public');
            }

            $sec1_imagePath = $about->sec1_image;

            if ($request->hasFile('sec1_image')) {
                if (Storage::exists('/public/' . $sec1_imagePath)) {
                    Storage::delete('/public/' . $sec1_imagePath);
                }

                $sec1_image = $request->file('sec1_image');

                // Store the sec1_image in a directory: 'public/about/'
                $generatedName = 'icons-sec1_image_' . time() . '.' . $sec1_image->getClientOriginalExtension();
                $sec1_imagePath = $sec1_image->storeAs('about', $generatedName, 'public');
            }

            $sec2_imagePath = $about->sec2_image;

            if ($request->hasFile('sec2_image')) {
                if (Storage::exists('/public/' . $sec2_imagePath)) {
                    Storage::delete('/public/' . $sec2_imagePath);
                }

                $sec2_image = $request->file('sec2_image');

                // Store the sec2_image in a directory: 'public/about/'
                $generatedName = 'icons-sec2_image_' . time() . '.' . $sec2_image->getClientOriginalExtension();
                $sec2_imagePath = $sec2_image->storeAs('about', $generatedName, 'public');
            }

            $about->update([
                'background_image' => $backgroundImagePath,
                'sec1_image' => $sec1_imagePath,
                'sec2_image' => $sec2_imagePath,
            ]);
            $about->refresh();

            $langs = Lang::where('is_published', true)->get();

            foreach ($langs as $lang) {
                if ($request->input('title_' . $lang->code)) {
                    $about->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'title',
                        ],
                        [
                            'content' => $request->input('title_' . $lang->code),
                        ]
                    );
                }

                if ($request->input('sub_title_' . $lang->code)) {
                    $about->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'sub_title',
                        ],
                        [
                            'content' => $request->input('sub_title_' . $lang->code),
                        ]
                    );
                }

                if ($request->input('sec1_description_' . $lang->code)) {
                    $about->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'sec1_description',
                        ],
                        [
                            'content' => $request->input('sec1_description_' . $lang->code),
                        ]
                    );
                }

                if ($request->input('sec2_description_' . $lang->code)) {
                    $about->translations()->updateOrCreate(
                        [
                            'lang_id' => $lang->id,
                            'column_name' => 'sec2_description',
                        ],
                        [
                            'content' => $request->input('sec2_description_' . $lang->code),
                        ]
                    );
                }
            }

            toastr('Updated successfully');

            DB::commit();
            return redirect()->route('dash.abouts.index');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors([
                'error' => 'Error. Can\'t update',
            ]);
        }
    }
}
