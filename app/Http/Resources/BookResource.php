<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'author' => $this->author,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => UserResource::collection(User::where('id', $this->user_id)->get()),
        ];
    }
}
