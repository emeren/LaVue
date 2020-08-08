<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;
use App\Http\Resources\PermissionsResource;

class PermissionController extends Controller
{
     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     function __construct()
     {
          $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
          $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
          $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
          $this->middleware('permission:role-delete', ['only' => ['destroy']]);
     }

     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function index(Request $request)
     {
          $permissions = Permission::all();
          return PermissionsResource::collection($permissions);
     }
}
