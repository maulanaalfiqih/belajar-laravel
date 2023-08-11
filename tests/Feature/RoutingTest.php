<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/momo')
            ->assertStatus(200)
            ->assertSeeText('Halo momo ganteng');
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/momo');
    }

    public function testFallback() 
    {
        $this->get('/notfound')
            ->assertSeeText('404');
    }
}
