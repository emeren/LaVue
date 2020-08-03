<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\MigrateFreshDB;
use Tests\ResetsDatabase;
use Tests\TestCase;
use App\User;

class UsersTest extends TestCase
{
    // use MigrateFreshDB;
    use ResetsDatabase;
    /**
     * Authenticated user can access API users
     * @test
     * @return void
     */
    public function authenticated_user_can_access_users_api()
    {
        $this->signIn();
        $this->assertAuthenticated();
        $apiEndpoint = $this->get('/panel/api/users');
        $apiEndpoint->assertSuccessful();
    }
    /**
     * Not authenticated user cannot access API users
     * @test
     * @return void
     */
    public function not_authenticated_user_can_access_users_api()
    {
        $this->assertGuest();
        $apiEndpoint = $this->get('/panel/api/users');
        $apiEndpoint->assertRedirect();
        $apiEndpoint = $this->followRedirects($apiEndpoint);
        $apiEndpoint->assertSuccessful()->assertViewIs('backend.auth.login');
    }
    /**
     * Check USERS API methods
     * @test
     * @dataProvider api_users_metods
     */
    public function check_users_api_methods($method, $responseCode)
    {
        $this->signIn();
        $response = $this->json($method, in_array($method, ['PUT', 'DELETE']) ? '/panel/api/users/1' : '/panel/api/users', [
            "name" => 'test',
            "email" => 'test@example.net',
            'password' => Hash::make('123456'),
            "allowed_login" => true
        ]);
        $response->assertStatus($responseCode);
    }

    /**
     * API users returns JSON with expected fields
     * @test
     * @return void
     */
    public function api_users_returns_json_with_expected_fields()
    {
        $this->signIn();
        $apiEndpoint = $this->getJson('/panel/api/users');
        $apiEndpoint->assertSuccessful();
        $apiEndpoint->assertJsonStructure([
            "data" => [
                0 => ["id", "name", "email", "allowed_login", "created_at", "updated_at"]
            ]
        ]);
    }
    /**
     * API creates records in table USERS
     * @test
     * @return void
     */
    public function api_users_creates_db_records()
    {
        $this->signIn();
        $this->assertDatabaseMissing(
            'users',
            [
                "name" => 'test',
                "email" => 'test@example.net',
                "allowed_login" => true,
                'password' => Hash::make('123456')
            ]
        );
        $response = $this->json('POST', '/panel/api/users', [
            "name" => 'test',
            "email" => 'test@example.net',
            'password' => Hash::make('123456'),
            "allowed_login" => true,
        ], ['Content-Type' => 'application/json']);
        $this->assertDatabaseHas(
            'users',
            [
                "name" => 'test',
                "email" => 'test@example.net',
                "allowed_login" => true,
            ]
        );
    }
    /**
     * API modify records in database
     * @test
     * @return void
     */
    public function api_users_can_update_records()
    {
        $this->signIn();
        $user = factory(User::class)->create([
            'name' => 'test',
            'email' => 'test@example.net',
            'password' => Hash::make('123456'),
            'allowed_login' => true
        ]);
        $this->assertDatabaseHas(
            'users',
            [
                "name" => 'test',
                "email" => 'test@example.net',
                "allowed_login" => true,
            ]
        );
        // $id = $response->json('id');
        $update = $this->json('PUT', '/panel/api/users/' . $user->id, [
            "name" => 'test2',
        ], ['Content-Type' => 'application/json']);
        $this->assertDatabaseHas(
            'users',
            [
                "name" => 'test2',
                "email" => 'test@example.net',
                "allowed_login" => true,
            ]
        );
    }
    /**
     * API Users can delete records
     * @test
     */
    public function api_users_can_delete_records()
    {
        $this->signIn();
        $user = factory(User::class)->create([
            'name' => 'test', 'email' => 'test@example.net', 'password' => Hash::make('123456'), 'allowed_login' => true
        ]);
        $this->assertDatabaseHas(
            'users',
            [
                'name' => 'test', 'email' => 'test@example.net', 'allowed_login' => true, 'deleted_at' => null
            ]
        );

        $delete = $this->deleteJson('/panel/api/users/' . $user->id);
        // dump($delete);
        $this->assertDatabaseHas(
            'users',
            [
                'name' => 'test', 'email' => 'test@example.net', 'allowed_login' => true, 'deleted_at' => now()
            ]
        );
        $retry_delete = $this->deleteJson('/panel/api/users/' . $user->id);
        $retry_delete->assertNotFound();
    }

    /**
     * Methods for API USERS
     *
     * @return void
     */
    public function api_users_metods()
    {
        $methods = [
            ['GET', 200], ['POST', 201], ['PUT', 200], ['DELETE', 204],
        ];
        return $methods;
    }
}
