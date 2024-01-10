<?php

namespace App\Http\Resources;

use App\Http\Resources\StaffImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
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
            'email' => $this->email,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'job_title' => $this->job_title,
            'image' => asset('storage/staff/profileimage/'.$this->image),
            'views'=> $this->whenLoaded('views'),
            'likes'=> $this->whenLoaded('likes'),
            'isPublished' => $this->isPublished,
            'isFeatured' => $this->isFeatured,
        ];
    }
}
