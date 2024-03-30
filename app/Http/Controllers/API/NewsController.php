<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\News\ApiNewsResource;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->limit) {
            $news = News::with('translations.lang')->orderBy('updated_at', 'desc')->paginate($request->limit);
        } else {
            $news = News::with('translations.lang')->orderBy('updated_at', 'desc')->get();
        }

        return ApiNewsResource::collection($news);
    }

    public function show(News $news)
    {
        return new ApiNewsResource($news);
    }
}
