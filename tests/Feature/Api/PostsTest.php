<?php

namespace Tests\Feature\Api;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ResetsDatabase;
use Tests\TestCase;
use App\Category;

class PostsTest extends TestCase
{
    use ResetsDatabase;
    /**
     * Authenticated user can access API posts
     * @test
     * @return void
     */
    public function authenticated_user_can_access_posts_api()
    {
        $this->signIn();
        $this->assertAuthenticated();
        $apiEndpoint = $this->get('/panel/api/posts');
        $apiEndpoint->assertSuccessful();
    }

    /**
     * Authenticated user can access API psingle post
     * @test
     * @return void
     */
    public function authenticated_user_can_access_single_post_api()
    {
        $category = Category::firstOrFail();

        $this->signIn();
        $this->assertAuthenticated();

        $post =  Post::firstOrCreate([
            'title' => 'test',
            'description' => 'test',
            'user_id' => 1,
            'thumbnail' => 'test',
            'gallery' => 'test',
            'publish_from' => date('Y-m-d', date_timestamp_get(now())),
            'publish_to' => date('Y-m-d', date_timestamp_get(now())),
            'published' => true,
        ]);
        $apiEndpoint = $this->get('/panel/api/posts/' . $post->id);
        $apiEndpoint->assertSuccessful();
    }
    /**
     * Not authenticated user cannot access API posts
     * @test
     * @return void
     */
    public function not_authenticated_user_can_access_posts_api_only_get()
    {
        $this->assertGuest();
        $apiEndpoint = $this->get('/panel/api/posts');
        $apiEndpoint->assertSuccessful();

        $apiEndpoint = $this->post('/panel/api/posts', []);
        $apiEndpoint->assertRedirect();
        $apiEndpoint = $this->followRedirects($apiEndpoint);
        $apiEndpoint->assertSuccessful()->assertViewIs('backend.auth.login');
        $apiEndpoint = $this->put('/panel/api/posts/1', []);
        $apiEndpoint->assertRedirect();
        $apiEndpoint = $this->followRedirects($apiEndpoint);
        $apiEndpoint->assertSuccessful()->assertViewIs('backend.auth.login');
        $apiEndpoint = $this->delete('/panel/api/posts/1', []);
        $apiEndpoint->assertRedirect();
        $apiEndpoint = $this->followRedirects($apiEndpoint);
        $apiEndpoint->assertSuccessful()->assertViewIs('backend.auth.login');
    }

    /**
     * API posts returns JSON with expected fields
     * @test
     * @return void
     */
    public function api_posts_returns_json_with_expected_fields()
    {
        $this->signIn();
        $apiEndpoint = $this->getJson('/panel/api/posts');
        $apiEndpoint->assertSuccessful();
        $apiEndpoint->assertJsonStructure([
            'data' => [
                0 => [
                    'id', 'title', 'description', 'thumbnail', 'gallery', 'publish_from', 'publish_to', 'published', 'created_at', 'updated_at'
                ]
            ]
        ]);
    }
    /**
     * API creates records in table posts
     * @test
     * @return void
     */
    public function api_posts_creates_db_records()
    {
        $this->signIn();
        $this->assertDatabaseMissing(
            'posts',
            [
                'title' => 'test',
                'description' => 'test',
                'thumbnail' => 'test',
                'gallery' => 'test',
                'publish_from' => date('Y-m-d', date_timestamp_get(now())),
                'publish_to' => date('Y-m-d', date_timestamp_get(now())),
                'published' => true,
            ]
        );
        $userId = User::all()->random()->id;
        $response = $this->json('POST', '/panel/api/posts', [
            'title' => 'test',
            'description' => 'test',
            'user_id' => $userId,
            'thumbnail' => 'test',
            'gallery' => 'test',
            'publish_from' => date('Y-m-d', date_timestamp_get(now())),
            'publish_to' => date('Y-m-d', date_timestamp_get(now())),
            'published' => true,
        ], ['Content-Type' => 'application/json']);
        $this->assertDatabaseHas(
            'posts',
            [
                'title' => 'test',
                'description' => 'test',
                'user_id' => $userId,
                'thumbnail' => 'test',
                'gallery' => 'test',
                'publish_from' => date('Y-m-d', date_timestamp_get(now())),
                'publish_to' => date('Y-m-d', date_timestamp_get(now())),
                'published' => true,
            ]
        );
    }
    /**
     * API modify records in database
     * @test
     * @return void
     */
    public function api_posts_can_update_records()
    {
        $this->signIn();
        $post = factory(Post::class)->create([
            'title' => 'title1',
            'description' => 'desc1',
            'user_id' => User::all()->random()->id,
            'thumbnail' => 'test',
            'gallery' => 'test',
            'publish_from' => date('Y-m-d', date_timestamp_get(now())),
            'publish_to' => date('Y-m-d', date_timestamp_get(now())),
            'published' => true,
        ]);
        $this->assertDatabaseHas(
            'posts',
            [
                'title' => 'title1',
                'description' => 'desc1',
                'thumbnail' => 'test',
                'gallery' => 'test',
                'publish_from' => date('Y-m-d', date_timestamp_get(now())),
                'publish_to' => date('Y-m-d', date_timestamp_get(now())),
                'published' => true,
            ]
        );
        // $id = $response->json('id');
        $update = $this->json('PUT', '/panel/api/posts/' . $post->id, [
            'title' => 'title2',
            'description' => 'desc2'
        ], ['Content-Type' => 'application/json']);
        $this->assertDatabaseHas(
            'posts',
            [
                'title' => 'title2',
                'description' => 'desc2',
                'thumbnail' => 'test',
                'gallery' => 'test',
                'publish_from' => date('Y-m-d', date_timestamp_get(now())),
                'publish_to' => date('Y-m-d', date_timestamp_get(now())),
                'published' => true,
            ]
        );
    }
    /**
     * API posts can delete records
     * @test
     */
    public function api_posts_can_delete_records()
    {
        $this->refreshApplication();
        $this->signIn();
        $post = factory(Post::class)->create([
            'title' => 'title1',
            'description' => 'desc1',
            'user_id' => User::all()->random()->id,
            'thumbnail' => 'test',
            'gallery' => 'test',
            'publish_from' => date('Y-m-d', date_timestamp_get(now())),
            'publish_to' => date('Y-m-d', date_timestamp_get(now())),
            'published' => true,
        ]);
        $this->assertDatabaseHas(
            'posts',
            [
                'title' => 'title1',
                'description' => 'desc1',
                'thumbnail' => 'test',
                'gallery' => 'test',
                'publish_from' => date('Y-m-d', date_timestamp_get(now())),
                'publish_to' => date('Y-m-d', date_timestamp_get(now())),
                'published' => true,
            ]
        );

        $delete = $this->deleteJson('/panel/api/posts/' . $post->id);
        // dump($delete);
        $this->assertDatabaseHas(
            'posts',
            [
                'title' => 'title1',
                'description' => 'desc1',
                'thumbnail' => 'test',
                'gallery' => 'test',
                'publish_from' => date('Y-m-d', date_timestamp_get(now())),
                'publish_to' => date('Y-m-d', date_timestamp_get(now())),
                'published' => true,
            ]
        );
        $retry_delete = $this->deleteJson('/panel/api/posts/' . $post->id);
        $retry_delete->assertNotFound();
    }


    //TODO use can save multiply category in posts

    //TODO use can delete multiply category in posts


}
