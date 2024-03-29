<?php

namespace App\Http\Responses\Banner;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiBannerResource extends JsonResource
{
    public static $wrap = false;

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'file' => $this->file,
            'type' => $this->type,
            'file_type' => $this->file_type,
            'title' => $this->title,
        ];
    }
}
