<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\MigrateFreshDB;
use Tests\ResetsDatabase;

class MigrateDBTest extends TestCase
{
    // use MigrateFreshDB;
    use ResetsDatabase;
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function database_has_users_table()
    {
        $this->assertDatabaseHas('users', ['email' => 'admin@lavue-cms.com']);
    }
}
