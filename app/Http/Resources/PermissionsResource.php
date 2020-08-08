<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB;

class PermissionsResource extends JsonResource
{
     /**
      * Transform the resource into an array.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return array
      */
     public function toArray($request)
     {
          return [
               'id' => $this->id,
               'name' => $this->name,
               'guard_name' => $this->guard_name
          ];
     }
}
