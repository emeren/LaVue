<?php

namespace Tests;

use Illuminate\Support\Facades\File;

/**
 * Makes fresh copy of testing DB - used in TEST
 */
trait ResetsDatabase
{
    public function resetDatabaseFile()
    {
        $path = base_path() . '/tests/_data/sqlite/';
        File::copy($path . 'dump.sqlite', $path . 'active.sqlite');
    }
}
