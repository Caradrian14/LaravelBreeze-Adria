<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GangaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'prices'=> $this->price,
            'available'=> $this->available,
            'category'=> optional($this->category)->title,
            'user'=> optional($this->user)->name,
            'user_id'=> $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
