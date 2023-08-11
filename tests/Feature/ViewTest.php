<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText("Hello momo");

        $this->get('/hello-again')
            ->assertSeeText("Hello ujang");
    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText("World ujang");
    }

    public function testTemplateWithoutRoutes()
    {
        $this->view('hello', ['name' => 'momo'])
            ->assertSeeText('Hello momo');

        $this->view('hello.world', ['name' => 'ujang'])
            ->assertSeeText('World ujang');
    }
}
