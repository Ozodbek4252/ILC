<?php

namespace App\Http\Responses\Partner;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiPartnerResource extends JsonResource
{
    public static $wrap = false;

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->image_url,
            'name' => $this->name,
        ];
    }
}
