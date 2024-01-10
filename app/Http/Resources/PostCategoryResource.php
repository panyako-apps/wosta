<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCategoryResource extends JsonResource
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
            'parent_id' => $this->parent_id,
            'parent'=>$this->parentCategory,
            'slug' => $this->slug,
            'image' => asset('storage/postcategory/coverimage/'.$this->image) ,
            'published_by' => User::find($this->published_by),
            'isPublished' => $this->isPublished,
            'isFeatured' => $this->isFeatured,
            'published_at' => $this->published_at,
            'updated_at' => $this->updated_at,
            'created_at'=>Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
