<?php

namespace App\Http\Responses\Seo;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiSeoResource extends JsonResource
{
    public static $wrap = false;

    public function toArray($request)
    {
        return [
            'keywords' => $this->keywords,
            'description' => $this->description,
        ];
    }
}
