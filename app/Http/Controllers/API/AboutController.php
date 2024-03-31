<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\About\ApiAboutResource;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::with('translations.lang')->orderBy('updated_at', 'desc')->get();

        return ApiAboutResource::collection($about);
    }
}
