<?php

namespace App\Http\Responses\Tariff;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiTariffResource extends JsonResource
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
            'icon_id' => $this->icon_id,
            'icon' => $this->icon_path,
            'price' => $this->price,
            'link' => $this->link,
            'name' => $translations['name'],
            'delivery_time' => $translations['delivery_time'],
            'schedule' => $translations['schedule'],
            'unit' => $translations['unit'],
        ];
    }
}
