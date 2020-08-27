<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\PostsResource;

class UsersResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        //flat nested roles array
        $userRoles = $this->roles->toArray();
        $rolesIds = [];
        foreach ($userRoles as $value) {
            array_push($rolesIds, $value['id']);
        }


        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'thumbnail' => $this->thumbnail,
            'allowed_login' => $this->allowed_login,
            'posts' => PostsResource::collection($this->posts),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => optional($this->updated_at)->format('Y-m-d H:i:s'),
            'deleted_at' => optional($this->deleted_at)->format('Y-m-d H:i:s'),
            'roles' => $rolesIds
        ];
    }
}
