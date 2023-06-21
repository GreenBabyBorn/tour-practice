<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'from' => $this->from,
            'to' => $this->to,
            'date' => $this->date,
            'cost' => $this->cost,
            'photos' => TourPhotoResource::collection($this->photos),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}