<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\Service\ApiServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->limit) {
            $services = Service::with('translations.lang')->orderBy('updated_at', 'desc')->paginate($request->limit);
        } else {
            $services = Service::with('translations.lang')->orderBy('updated_at', 'desc')->get();
        }

        return ApiServiceResource::collection($services);
    }
}
