<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\Banner\ApiBannerResource;
use App\Models\Banner;

class BannerController extends Controller
{
    public function get()
    {
        $banner =  Banner::with('translations.lang')->orderBy('updated_at', 'desc')->where('is_published', true)->first();

        $collection = $banner->translations;
        $groupedByLang = $collection->groupBy(function ($item) {
            return $item->column_name;
        });

        $groupedByLang = $groupedByLang->map(function ($group) {
            return $group->groupBy('lang.code')->map->first();
        });

        $translations = $groupedByLang->map(function ($group) {
            return $group->map(function ($item) {
                return $item->content;
            });
        });

        $translations->map(function ($items, $name) use (&$banner) {
            $banner[$name] = $items->toArray();
        });

        return new ApiBannerResource($banner);
    }
}
