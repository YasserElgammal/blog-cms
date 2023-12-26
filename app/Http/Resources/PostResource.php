<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $routeShow = Route::currentRouteName() == 'post.show';

        return [
            'id' => $this->id,
            'title' => $this->title,
            $this->mergeWhen($routeShow , ['content' => $this->content]),
            'image' => $this->image,
            'created_at' => $this->created_at,
            'user' => UserResource::make($this->whenLoaded('user')),
            'category' => GeneralResource::make($this->whenLoaded('category')),
            'tags' => GeneralResource::collection($this->whenLoaded('tags')),
        ];
    }
}
