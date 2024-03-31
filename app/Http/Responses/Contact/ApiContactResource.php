<?php

namespace App\Http\Responses\Contact;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiContactResource extends JsonResource
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
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $translations['address'],
            'schedule' => $translations['schedule'],
        ];
    }
}
