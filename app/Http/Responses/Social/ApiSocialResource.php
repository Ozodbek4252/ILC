<?php

namespace App\Http\Responses\Social;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiSocialResource extends JsonResource
{
    public static $wrap = false;

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'icon_id' => $this->icon_id,
            'icon' => $this->icon_path,
            'link' => $this->link,
            'name' => $this->name,
        ];
    }
}
