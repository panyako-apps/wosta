<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
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
            'username' => $this->username,
            'profileimage' => asset('storage/user/profileimage/'.$this->profileimage) ,
            'avatar' => $this->avatar,
            'phone' => $this->phone,
            'description' => $this->description,
        ];    
    }
}