<?php
namespace Tests;

use Illuminate\Support\Facades\Artisan;

/**
 * Migrate and seed fresh test DB
 */
trait MigrateFreshDB
{
    protected static $migrationHasRunOnce = false;
    public function migrateFreshDB()
    {
        if (!static::$migrationHasRunOnce) {
            Artisan::call('migrate:fresh', ['--database' => 'sqlite_fresh']);
            Artisan::call('db:seed', ['--class' => 'sqliteDB_seeder', '--database' => 'sqlite_fresh']);
            // Artisan::call('db:seed', ['--class' => 'testUserSeeder']);
            static::$migrationHasRunOnce = true;
        }
    }
}
