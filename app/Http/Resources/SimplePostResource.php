<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SimplePostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image,
            'created_at' => $this->created_at,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
