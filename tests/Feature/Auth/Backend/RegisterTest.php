<?php

namespace Tests\Feature;

use App\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\ResetsDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
     use ResetsDatabase;

     /**
      * The registration form can be displayed.
      * @test
      * @return void
      */
     public function register_form_displayded()
     {
          $response = $this->get('/panel/register');
          $response->assertStatus(200);
     }

     /**
      * A valid user can be registered.
      * @test
      * @return void
      */
     public function register_a_valid_user()
     {
          $user = factory(User::class)->make();

          $userData = [
               'name' => $user->name,
               'email' => $user->email,
               'password' => 'password',
               'password_confirmation' => 'password'
          ];

          $response = $this->post('panel/register', $userData);
          $this->assertGuest();

          $response
               ->assertStatus(302)
               ->assertRedirect('/panel/login')
               ->assertSessionHas('status', trans('auth.created'));

          array_splice($userData, 2, 2);
          $this->assertDatabaseHas('users', $userData);
     }

     /**
      * An invalid user is not registered.
      * @test
      * @return void
      */
     public function dont_register_a_invalid_user()
     {
          $user = factory(User::class)->make();

          $response = $this->post('/panel/register', [
               'name' => $user->name,
               'email' => $user->email,
               'password' => 'password',
               'password_confirmation' => 'invalid'
          ]);;

          $response->assertStatus(302);
          //TODO add assertion about error
     }
}
