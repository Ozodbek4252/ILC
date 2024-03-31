<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\Tariff\ApiTariffResource;
use App\Models\Tariff;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    public function index(Request $request)
    {
        if ($request->limit) {
            $tariffs = Tariff::with('translations.lang')->orderBy('updated_at', 'desc')->paginate($request->limit);
        } else {
            $tariffs = Tariff::with('translations.lang')->orderBy('updated_at', 'desc')->get();
        }

        return ApiTariffResource::collection($tariffs);
    }
}
