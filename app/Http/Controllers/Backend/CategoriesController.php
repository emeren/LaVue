<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResource;

use App\Post;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('parent_id', null)->get();
        return CategoriesResource::collection($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
        ])->validate();

        $category = new Category($request->all());
        $store = $category->save();
        // return UsersResource::make($user);
        if ($store) {
            return response()->make(CategoriesResource::make($category), 201);
        } else {
            return response()->json(['Error' => 'Failed to store record'], 500);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $memberId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $categoryId): JsonResponse
    {
        $category = Category::find($categoryId);
        if (!$category) {
            return response()->json(['Error' => 'Not Found'], 404);
        }
        return response()->json(CategoriesResource::make($category), 200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $catId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $catId)
    {



        $category = Category::find($catId);
        if (!$category) {
            return response()->json(['Error' => 'Not Found'], 404);
        }


        //TODO Change parent child order
        if ($request->has('parentId') && $request->has('id')) {
            $category->parent_id = $request->has('parentId');
            $update = $category->save();
            if ($update) {
                return response(CategoriesResource::make($category), 200);
            } else {
                return response()->json(['Error' => 'Record update failed'], 500);
            }
            return response(CategoriesResource::make($category), 200);
        }


        $fields = ['name', 'description', 'published',];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $category->$field = request($field);
            }
        }
        $update = $category->save();
        if ($update) {
            return response(CategoriesResource::make($category), 200);
        } else {
            return response()->json(['Error' => 'Record update failed'], 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $memberId
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $categoryId)
    {
        $category = Category::with('posts')->find($categoryId);
        if ($category) {
            $category->posts()->detach();
            $delete = $category->delete();
        } else {
            return response()->json(['Error' => 'Not Found'], 404);
        }
        if ($delete) {
            return response()->json([], 204);
        } else {
            return response()->json(['Error' => 'Fail to delete record'], 500);
        }
    }
}
