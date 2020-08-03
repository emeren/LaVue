<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\ResetsDatabase;
use Tests\TestCase;
use Illuminate\Auth\Notifications\ResetPassword;


class ResetPasswordTest extends TestCase
{
    use ResetsDatabase;

    /**
     * User can see reset form
     * @test
     * @return void
     */
    public function user_can_see_reset_password_form()
    {
        $response = $this->get('/panel/password/reset');
        $response->assertSuccessful();
        $response->assertViewIs('backend.auth.passwords.email');
    }

    /**
     * Dont send a password reset email when the user does not exist.
     *
     * @return void
     */
    public function dont_send_when_email_nOt_exists()
    {
        $response = $this->post('password/email', ['email' => 'undefind@email.com']);
        $response
            ->assertStatus(302);
        $this->doesntExpectJobs(ResetPassword::class);
    }

    /**
     * Sends the password reset email when the user exists.
     * @test
     * @return void
     */
    public function send_password_reset_email()
    {
        $user = factory(User::class)->create();
        $this->expectsNotification($user, ResetPassword::class);
        $response = $this->post('panel/password/email', ['email' => $user->email]);
        $response
            ->assertStatus(302)
            ->assertSessionHas('status', trans('passwords.sent'));
    }

    /**
     * Allows a user to reset their password.
     * @test
     * @return void
     */
    public function user_can_change_his_own_password()
    {
        $user = factory(User::class)->create();
        $token = Password::createToken($user);
        $response = $this->post('panel/password/reset', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }
}
