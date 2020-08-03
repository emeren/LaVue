<?php

namespace Tests;

// use Tests\ResetsCarbon;
use Tests\ResetsDatabase;
use Tests\MigrateFreshDB;

trait ExtendsTraitSetup
{
    public function setUpTraits()
    {
        parent::setUpTraits();
        $this->extendSetup();
    }

    public function extendSetup()
    {
        $uses = array_flip(class_uses_recursive(static::class));

        if (isset($uses[ResetsDatabase::class])) {
            $this->resetDatabaseFile();
        }
        if (isset($uses[MigrateFreshDB::class])) {
            $this->MigrateFreshDB();
        }
    }
}
