<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoverInformationResource extends JsonResource
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
            "title" => $this->title,
            "child_title" => $this->child_title,
            "description" => $this->description,
            "accounts_id" => $this->accounts_id,
            "image" => $this->image,
            "list_cover_information" => ListCoverInformationResource::collection($this->list_cover_information)
        ];
    }
}
