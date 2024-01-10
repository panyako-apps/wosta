<?php

namespace App\Http\Resources;

use App\Http\Resources\TestimonialImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
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
            'title' => $this->title,
            'testimony' => $this->testimony,
            'job_title' => $this->job_title,
            'image' => asset('storage/testimonial/profileimage/'.$this->image),
            'isPublished' => $this->isPublished,
            'isFeatured' => $this->isFeatured,
        ];
    }
}
