<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    
    protected $folder;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'url'=>asset('storage/'.$request->get('folder').'/images'.'/'.$this->url),
            'views'=> $this->views,
            'likes'=> $this->likes,
            'isPublished' => $this->isPublished,
            'isFeatured' => $this->isFeatured,
        ];
    }
}
