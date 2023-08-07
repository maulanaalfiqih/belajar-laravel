<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class EnvironmentTest extends TestCase
{
    public function testGetEnv()
    {
        //env bentuk function
        $youtube = env('YOUTUBE');
        self::assertEquals('Programmer Zaman Now', $youtube);
    }

    public function testDefaultEnv()
    {
        //env bentuk class
        //set default value di parameter kedua
        $author = Env::get('AUTOR', 'MOMO');
        self::assertEquals('MOMO', $author);
    }
}
