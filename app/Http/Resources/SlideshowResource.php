<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\SlideResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SlideshowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user'=> User::find($this->user_id),
            'name' => $this->name,
            'description' => $this->description,
            'isPublished'=>$this->isPublished,
            'published_by' => User::find($this->published_by),
            'published_at' => $this->published_at,
            'updated_by' => User::find($this->updated_by),
            'updated_at' => $this->updated_at,            
            'slides' => SlideResource::collection($this->whenLoaded('slides')),
        ];
    }
}
