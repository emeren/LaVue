<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;


abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, ExtendsTraitSetup;

    /**
     * Logowanie usera
     *
     * @return void
     */
    public function signIn()
    {
        $user = User::find(1);
        $this->actingAs($user);
    }
}
