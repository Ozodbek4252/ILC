<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\Seo\ApiSeoResource;
use App\Models\Seo;

class SeoController extends Controller
{
    public function get()
    {
        $seo = Seo::first();

        return new ApiSeoResource($seo);
    }
}
