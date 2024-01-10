<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\User;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'id' => $this->id,
            'user'=> User::find($this->user_id),
            'name' => $this->name,
            'post_category_id' => $this->post_category_id,
            'description' => $this->description,
            'slug' => $this->slug,
            'image' => asset('storage/post/coverimage/'.$this->image) ,
            'tags' => $this->tags,
            'published_by' => User::find($this->published_by),
            'isPublished' => $this->isPublished,
            'isFeatured' => $this->isFeatured,
            'category'=> $this->whenLoaded('postCategory'),
            'published_at' => $this->published_at,
            'updated_at' => $this->updated_at,
            'views'=> $this->views,
            'likes'=> $this->likes,
            'comments'=> $this->comments,
            'created_at'=>Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}





