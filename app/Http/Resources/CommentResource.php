<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\User;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = User::find($this->user_id);

        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'comment' => $this->comment,
            'user' => $user,
            'profileimage'=>asset('storage/user/profileimage/'.$user->userProfile->profileimage),
            'avatar'=>$user->userProfile->avatar,
            'profile'=>$user->userProfile,
            'name' => $this->name,
            'email' => $this->email,
            'comments' => CommentResource::collection($this->comments),
            'likes' => $this->likes,
            'isPublished' => $this->isPublished,
            'isFeatured' => $this->isFeatured,
            'created_at'=>Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
