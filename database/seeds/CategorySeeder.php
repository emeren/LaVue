<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('DB_CONNECTION') == 'sqlite_testing') {
            // dla testów na sztywno wpisana ilość
            $categories_count  = 2;
        } else {
            $categories_count = 2;
        }

        $this->command->getOutput()->progressStart($categories_count);
        for ($i = 0; $i < $categories_count; $i++) {
            factory(App\Category::class)->create()->each(function ($category) {
                $count = random_int(0, 2);
                if ($count > 0) {
                    $category->children()->saveMany(factory(App\Category::class, $count)->make());
                }
                $category->posts()->saveMany(factory(App\Post::class, 10)->create());
            });
        }

        $this->command->getOutput()->progressFinish();
    }
}
