<?php

namespace Tests;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        // DB::delete("delete from products");
        // DB::delete("delete from vendors");
        // DB::delete("delete from users");
    }
}
