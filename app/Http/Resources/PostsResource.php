<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\UsersResource;
use App\Category;


class PostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {


        //flat nested categories array
        $postCategories = $this->categories->toArray();
        $categoriesIds = [];
        foreach ($postCategories as $value) {
            array_push($categoriesIds, $value['id']);
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'author' => $this->author,
            'thumbnail' => $this->thumbnail,
            'gallery' => $this->gallery,
            'publish_from' => (string) $this->publish_from,
            'publish_to' =>  (string) $this->publish_to,
            'published' => $this->published,
            'categories'  => $categoriesIds,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => optional($this->updated_at)->format('Y-m-d H:i:s'),
            'deleted_at' => optional($this->deleted_at)->format('Y-m-d H:i:s'),
        ];
    }
}
