<?php

namespace Tests\Feature\Api;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ResetsDatabase;
use Tests\MigrateFreshDB;
use Tests\TestCase;
use App\Post;


class CategoriesTest extends TestCase
{

    use MigrateFreshDB;
    use ResetsDatabase;

    /**
     * Authenticated user can access API categories
     * @test
     * @return void
     */
    public function authenticated_user_can_access_categories_api()
    {
        $this->signIn();
        $this->assertAuthenticated();
        $apiEndpoint = $this->get('/panel/api/categories');
        $apiEndpoint->assertSuccessful();
    }


    /**
     * Authenticated user can access API single category
     * @test
     * @return void
     */
    public function authenticated_user_can_access_single_category_api()
    {
        $this->signIn();
        $this->assertAuthenticated();

        $category =  Category::firstOrCreate([
            'name' => 'test',
            'description' => 'test',
            'published' => true,
        ]);
        $apiEndpoint = $this->get('/panel/api/categories/' . $category->id);
        $apiEndpoint->assertSuccessful();
    }

    /**
     * Not authenticated user cannot access API categories
     * @test
     * @return void
     */
    public function not_authenticated_user_can_access_categories_api_only_get()
    {
        $this->assertGuest();
        $apiEndpoint = $this->get('/panel/api/categories');
        $apiEndpoint->assertSuccessful();

        $apiEndpoint = $this->post('/panel/api/categories', []);
        $apiEndpoint->assertRedirect();
        $apiEndpoint = $this->followRedirects($apiEndpoint);
        $apiEndpoint->assertSuccessful()->assertViewIs('backend.auth.login');
        $apiEndpoint = $this->put('/panel/api/categories/1', []);
        $apiEndpoint->assertRedirect();
        $apiEndpoint = $this->followRedirects($apiEndpoint);
        $apiEndpoint->assertSuccessful()->assertViewIs('backend.auth.login');
        $apiEndpoint = $this->delete('/panel/api/categories/1', []);
        $apiEndpoint->assertRedirect();
        $apiEndpoint = $this->followRedirects($apiEndpoint);
        $apiEndpoint->assertSuccessful()->assertViewIs('backend.auth.login');
    }

    /**
     * API categories returns JSON with expected fields
     * @test
     * @return void
     */
    public function api_categories_returns_json_with_expected_fields()
    {
        $this->signIn();
        $apiEndpoint = $this->getJson('/panel/api/categories');
        $apiEndpoint->assertSuccessful();
        $apiEndpoint->assertJsonStructure([
            'data' => [
                0 => [
                    'id', 'name', 'description', 'published', 'created_at', 'updated_at', 'children'
                ]
            ]
        ]);
    }
    /**
     * API creates records in table categories
     * @test
     * @return void
     */
    public function api_categories_creates_db_records()
    {
        $this->signIn();
        $this->assertDatabaseMissing(
            'categories',
            [
                'name' => 'test',
                'description' => 'test',
                'published' => true,
            ]
        );
        $response = $this->json('POST', '/panel/api/categories', [
            'name' => 'test',
            'description' => 'test',
            'published' => true,
        ], ['Content-Type' => 'application/json']);
        $this->assertDatabaseHas(
            'categories',
            [
                'name' => 'test',
                'description' => 'test',
                'published' => true,
            ]
        );
    }
    /**
     * API modify records in database
     * @test
     * @return void
     */
    public function api_categories_can_update_records()
    {
        $this->signIn();
        $category = factory(Category::class)->create([
            'name' => 'name1',
            'description' => 'desc1',
            'published' => true,
        ]);
        $this->assertDatabaseHas(
            'categories',
            [
                'name' => 'name1',
                'description' => 'desc1',
                'published' => true,
            ]
        );
        // $id = $response->json('id');
        $update = $this->json('PUT', '/panel/api/categories/' . $category->id, [
            'name' => 'name2',
            'description' => 'desc2',
            'published' => true,
        ], ['Content-Type' => 'application/json']);

        $this->assertDatabaseHas(
            'categories',
            [
                'name' => 'name2',
                'description' => 'desc2',
                'published' => true,
            ]
        );
    }
    /**
     * API categories can delete records
     * @test
     */
    public function api_categories_can_delete_records()
    {
        $this->signIn();
        $category = factory(Category::class)->create([
            'name' => 'name1',
            'description' => 'desc1',
            'published' => true,
        ]);
        $this->assertDatabaseHas(
            'categories',
            [
                'name' => 'name1',
                'description' => 'desc1',
                'published' => true,
            ]
        );

        $delete = $this->deleteJson('/panel/api/categories/' . $category->id);
        $retry_delete = $this->deleteJson('/panel/api/categories/' . $category->id);
        $retry_delete->assertNotFound();
    }
    /**
     * API categories can delete records
     * @test
     */
    public function api_categories_can_delete_records_without_deleting_category_posts()
    {
        $this->signIn();
        $category = factory(Category::class)->create([
            'name' => 'name1',
            'description' => 'desc1',
            'published' => true,
        ]);

        $category->posts()->create([

            'title' => 'name1',
            'description' => 'desc1',
            'thumbnail' => 'test',
            'gallery' => 'test',
            'publish_from' => date('Y-m-d', date_timestamp_get(now())),
            'publish_to' => date('Y-m-d', date_timestamp_get(now())),
            'published' => true,
        ]);

        $this->assertDatabaseHas(
            'category_post',
            [
                'category_id' => $category->id,
                'post_id' => $category->posts()->first()->id,
            ]
        );
        // $delete = $this->deleteJson('/panel/api/categories/' . $category->id);
        // $this->assertDatabaseHas(
        //     'posts',
        //     [
        //         'category_id' => null,
        //         'title' => 'name1',
        //         'description' => 'desc1',
        //     ]
        // );
    }

    /** Category children, parents
     * @test
     */
    public function category_can_has_children_parents()
    {
        // create master records
        $master = factory(Category::class, 3)->create();

        // get parent for the sub-categories
        $parent = $master->first();

        // create sub-categories
        foreach (range(1, 4) as $id) {
            factory(Category::class)->create([
                'name' => 'Sub category ' . $id,
                'parent_id' => $parent->id
            ]);
        }

        $this->assertEquals(
            ['Sub category 1', 'Sub category 2', 'Sub category 3', 'Sub category 4',],
            Category::where('name', $parent->name)->first()->children->pluck('name')->toArray()
        );
    }
}
