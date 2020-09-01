<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create 10 more users

        factory('App\User', 3)->create()->each(function ($user) {
            $count = random_int(1, 5);
            $user->posts()->saveMany(factory('App\Post', $count)->make());
        });;
    }
}
