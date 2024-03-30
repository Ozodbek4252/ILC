<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\FAQ\ApiFAQResource;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index(Request $request)
    {
        if ($request->limit) {
            $faqs = FAQ::with('translations.lang')->orderBy('updated_at', 'desc')->paginate($request->limit);
        } else {
            $faqs = FAQ::with('translations.lang')->orderBy('updated_at', 'desc')->get();
        }

        return ApiFAQResource::collection($faqs);
    }
}
