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
        $admin = new User([
            'name' => 'admin',
            'email' => 'admin@lavue-cms.com',
            'email_verified_at' => now(),
            'allowed_login' => true,
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password' => Hash::make('secret'), // password
            'remember_token' => Str::random(10),
        ]);
        $admin->save();

        //Create 10 more users
        factory('App\User', 10)->create();
    }
}
