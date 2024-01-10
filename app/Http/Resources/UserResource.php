<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\UserProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'profile' => UserProfileResource::make($this->userProfile),
            'roles' => $this->whenLoaded('roles'),
        ];
    }
}
