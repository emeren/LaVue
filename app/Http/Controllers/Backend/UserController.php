<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Hash;
use DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return UsersResource::collection($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        // return UsersResource::make($user);
        if ($user) {
            return response()->make(UsersResource::make($user), 201);
        } else {
            return response()->json(['Error' => 'Failed to store record'], 500);
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $userId)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $userId,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        }

        $user = User::find($userId);

        if (!$user) {
            return response()->json(['Error' => 'Not Found'], 404);
        }
        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $userId)->delete();
        $user->assignRole($request->input('roles'));
        if ($user) {
            return response(UsersResource::make($user), 200);
        } else {
            return response()->json(['Error' => 'Record update failed'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $userId)
    {
        $userForDelete = User::find($userId);
        if (empty($userForDelete)) {
            return response()->json(['Error' => 'Not Found'], 404);
        }
        try {
            $userForDelete->delete();
        } catch (\Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 500);
        }
        return response()->json([], 204);
    }
}
