<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "description" => $this->description,
            "logo" => $this->logo,
            "title_service" => $this->title_service,
            "animation_service" => $this->animation_service,
            "background" => BackgroundResource::collection($this->background)
        ];
    }
}
