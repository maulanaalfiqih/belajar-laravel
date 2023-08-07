<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AppEnvironment extends TestCase
{
    //mengecek environment aplikasi saat proses testing
    public function testAppEnv()
    {
        if (App::environment('testing')) {
            self::assertTrue(true);
        }
    }
}
