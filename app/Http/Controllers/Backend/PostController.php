<?php

namespace App\Http\Controllers\Backend;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PostsResource;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('categories')->orderBy('created_at', 'desc')->withTrashed()->get();
        return PostsResource::collection($posts);
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

        // $validatedData = $request->validate([
        //     "title" =>  ['required', 'unique:posts', 'max:150'],
        //     "description" => ['required'],
        // ]);



        $postData = [
            "title" => $request->title,
            "description" => $request->description,
            "thumbnail" => $request->thumbnail,
            "user_id" => $request->user_id,
            "gallery" => $request->gallery,
            "publish_from" => $request->publish_from,
            "publish_to" => $request->publish_to,
            "published" => $request->published,
            "created_at" => $request->created_at,
            "updated_at" => $request->updated_at,
            "deleted_at" => $request->deleted_at,
        ];

        $post = new Post($postData);

        $store = $post->save();
        if ($request->has('categories')) {
            $catIds = array_values($request->categories);
            $post->categories()->sync($catIds);
        }


        // return UsersResource::make($user);
        if ($store) {
            return response()->make(PostsResource::make($post), 201);
        } else {
            return response()->json(['Error' => 'Failed to store record'], 500);
        }

        //
    }

    /**
     * Display the specified post
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(int $post): JsonResponse
    {
        $post = Post::find($post);
        if (!$post) {
            return response()->json(['Error' => 'Not Found'], 404);
        }

        return response()->json(PostsResource::make($post), 200);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $postId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $postId)
    {

        Log::alert($request);
        $post = Post::find($postId);
        if (!$post) {
            return response()->json(['Error' => 'Not Found'], 404);
        }

        $fields = ['title', 'description', 'thumbnail', 'gallery', 'publish_from', 'publish_to', 'published',]; //fields allowed to update
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $post->$field = request($field);
            }
        }
        if ($request->has('categories')) {
            $catIds = array_values($request->categories);
            $post->categories()->sync($catIds);
        }

        $update = $post->save();
        if ($update) {
            return response(PostsResource::make($post), 200);
        } else {
            return response()->json(['Error' => 'Record update failed'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $postId)
    {
        //
        $postForDelete = Post::find($postId);
        if (empty($postForDelete)) {
            return response()->json(['Error' => 'Not Found'], 404);
        }
        try {
            $postForDelete->delete();
        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 500);
        }
        return response()->json([], 204);
    }
}
