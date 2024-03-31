<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\Counter\ApiCounterResource;
use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->limit) {
            $counters = Counter::with('translations.lang')->orderBy('updated_at', 'desc')->paginate($request->limit);
        } else {
            $counters = Counter::with('translations.lang')->orderBy('updated_at', 'desc')->get();
        }

        return ApiCounterResource::collection($counters);
    }
}
