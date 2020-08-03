<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // if (env('DB_CONNECTION') == 'sqlite_testing') {
        //     // dla testów na sztywno wpisana ilość
        //     $posts_count = 5;
        // } else {
        //     $posts_count = $this->command->ask('How many Posts should I create?', 5);
        // }
        // $this->command->getOutput()->progressStart($posts_count);
        // for ($i = 0; $i < $posts_count; $i++) {
        //     factory('App\Post', 1)->create();
        //     $this->command->getOutput()->progressAdvance();
        // }
        // $this->command->getOutput()->progressFinish();
    }
}
