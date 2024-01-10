<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'user'=> User::find($this->user_id),
            'name' => $this->name,
            'description' => $this->description,
            'service_category_id' => $this->service_category_id,
            'slug' => $this->slug,
            'tags' => $this->tags,
            'image' => asset('storage/service/coverimage/'.$this->image) ,
            'availability' => $this->availability,
            'published_by' => User::find($this->published_by),
            'published_at' => $this->published_at,
            'updated_by' => User::find($this->updated_by),
            'isFeatured' => $this->isFeatured,
            'isPublished' => $this->isPublished,
            'images'=> $this->whenLoaded('images'),
            'views'=> $this->whenLoaded('views'),
            'likes'=> $this->whenLoaded('likes'),
            'category'=> $this->whenLoaded('serviceCategory'),
            'updated_at' => $this->updated_at,            
        ];
    }
}

