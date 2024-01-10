<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\ServiceCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCategoryResource extends JsonResource
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
            'image' => asset('storage/servicecategory/icon/'.$this->image) ,
            'published_by' => User::find($this->published_by),
            'published_at' => $this->published_at,
            'updated_by' => User::find($this->updated_by),
            'isFeatured' => $this->isFeatured,
            'isPublished' => $this->isPublished,
            'parent'=> ServiceCategory::find($this->parent_id),
            'updated_at' => $this->updated_at,
            
        ];
    }
}
