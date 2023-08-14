<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText("Hello Response");
    }

    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText('Maulana')
            ->assertSeeText('Alfiqih')
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'Momo Ganteng')
            ->assertHeader('App', 'Laravel Cuy');
    }

    public function testView()
    {
        $this->get('/response/type/view')
            ->assertSeeText('Hello Maulana');
    }

    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertJson([
                'firstName' => 'Maulana',
                'lastName' => 'Alfiqih'
            ]);
    }

    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/jpeg');
    }

    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload('momo.png');
    }
}
