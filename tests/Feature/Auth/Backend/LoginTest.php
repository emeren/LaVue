<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\ResetsDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use ResetsDatabase;
    /**
     * User can see login form
     * @test
     * @return void
     */
    public function user_can_view_login_form()
    {
        $response = $this->get('/panel/login');
        $response->assertSuccessful();
        $response->assertViewIs('backend.auth.login');
    }
    /**
     * User can't see login form when authenticated
     * @test
     * @return void
     */
    public function user_cant_view_login_form_when_authenticated()
    {
        $this->signIn();
        $response = $this->get('/panel/login');
        $response->assertRedirect();
        $response = $this->followRedirects($response);
        $response->assertViewIs('backend.dashboard');
    }
    /**
     * User can login with correct credentials
     * @test
     * @return void
     */
    public function user_can_login_with_correct_credential()
    {
        $response = $this->followingRedirects()->post(
            '/panel/login',
            [
                'email' => 'admin@lavue-cms.com',
                'password' => 'secret'
            ]
        );
        $this->assertAuthenticated();
        $response->assertViewIs('backend.dashboard');
    }
    /**
     * User can't login with wrong password
     * @test
     * @return void
     */
    public function user_cannot_login_with_wrong_password()
    {
        $response = $this->post(
            '/panel/login',
            [
                'email' => 'admin@lavue-cms.com',
                'password' => 'wrongpassword'
            ]
        );
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
    /**
     * User can't login with wrong email
     * @test
     * @return void
     */
    public function user_cannot_login_with_wrong_email()
    {
        $response = $this->post(
            '/panel/login',
            [
                'email' => 'admin@wrong-emial.com',
                'password' => 'secret'
            ]
        );
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
    /**
     * User can't login without password
     * @test
     * @return void
     */
    public function user_cannot_login_without_password()
    {
        foreach (['', null] as $password) {
            $response = $this->post(
                '/panel/login',
                [
                    'email' => 'admin@lavue-cms.com',
                    'password' => $password
                ]
            );
            $response->assertSessionHasErrors();
            $this->assertGuest();
        }
    }
    /**
     * User can't login without creds
     * @test
     * @return void
     */
    public function user_cannot_login_without_creds()
    {
        foreach (['', null] as $email) {
            foreach (['', null] as $password) {

                $response = $this->post(
                    '/panel/login',
                    [
                        'email' => $email,
                        'password' => $password
                    ]
                );
                $response->assertSessionHasErrors();
                $this->assertGuest();
            }
        }
    }
}
