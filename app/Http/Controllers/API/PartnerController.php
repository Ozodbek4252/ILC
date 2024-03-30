<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\Partner\ApiPartnerResource;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{

    public function index(Request $request)
    {
        if ($request->limit) {
            $partners = Partner::orderBy('updated_at', 'desc')->paginate($request->limit);
        } else {
            $partners = Partner::orderBy('updated_at', 'desc')->get();
        }

        return ApiPartnerResource::collection($partners);
        return response()->json($partners);
    }
}
