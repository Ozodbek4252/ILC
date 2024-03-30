<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\Advantage\ApiAdvantageResource;
use App\Models\Advantage;
use Illuminate\Http\Request;

class AdvantageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->limit) {
            $advantages = Advantage::with('translations.lang')->orderBy('updated_at', 'desc')->paginate($request->limit);
        } else {
            $advantages = Advantage::with('translations.lang')->orderBy('updated_at', 'desc')->get();
        }

        return ApiAdvantageResource::collection($advantages);
    }
}
