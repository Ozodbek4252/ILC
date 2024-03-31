<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\Social\ApiSocialResource;
use App\Models\Social;

class SocialController extends Controller
{
    public function index()
    {
        $socials = Social::orderBy('updated_at', 'desc')->get();

        return ApiSocialResource::collection($socials);
    }
}
