<?php

namespace App\Http\Responses\About;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiAboutResource extends JsonResource
{
    public static $wrap = false;

    public function toArray($request)
    {
        $groupedByLang = collect($this->resource['translations'])->groupBy(function ($translation) {
            return $translation['column_name'];
        });

        $groupedByLang = $groupedByLang->map(function ($group) {
            return $group->groupBy('lang.code')->map->first();
        });

        $translations = $groupedByLang->map(function ($group) {
            return $group->map(function ($item) {
                return $item['content'];
            });
        });

        $translations = $translations->map(function ($items, $name) {
            return $items->toArray();
        })->toArray();

        return [
            'id' => $this->id,
            'background_image_url' => $this->background_image_url,
            'sec1_image_url' => $this->sec1_image_url,
            'sec2_image_url' => $this->sec2_image_url,
            'title' => $translations['title'],
            'sub_title' => $translations['sub_title'],
            'sec1_description' => $translations['sec1_description'],
            'sec2_description' => $translations['sec2_description'],
        ];
    }
}
