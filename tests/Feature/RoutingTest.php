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

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText("Product 1");

        $this->get('/products/1/items/ABC')
            ->assertSeeText("Product 1, Item ABC");
    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/69')
            ->assertSeeText("Category 69");

        $this->get('/categories/momo')
            ->assertSeeText("404");
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/70')
            ->assertSeeText("User 70");

        $this->get('/users/')
            ->assertSeeText("404");
    }

    public function testRouteConflict()
    {
        $this->get('/conflict/ujang')
            ->assertSeeText("Conflict ujang");

        $this->get('/conflict/momo')
            ->assertSeeText("Conflict momo");
    }

    public function testNamedRoute()
    {
        $this->get('/barang/999')
            ->assertSeeText("Link http://localhost/products/999");

        $this->get('/barang-redirect/999')
            ->assertSeeText("/products/999");
    }
}
