<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Momo')
            ->assertSeeText('Hello Momo');

        $this->post(
            '/input/hello',
            ['name' => 'Momo']
        )
            ->assertSeeText('Hello Momo');
    }

    public function testInputNested()
    {
        $this->post(
            '/input/hello/first',
            ['name' =>  [
                'first' => 'Momo'
            ]]
        )
            ->assertSeeText('Hello Momo');
    }

    public function testInputAll()
    {
        $this->post(
            '/input/hello/input',
            ['name' =>  [
                'first' => 'Momo',
                'last' => 'Alfiqih'
            ]]
        )
            ->assertSeeText('name')
            ->assertSeeText('first')
            ->assertSeeText('Momo')
            ->assertSeeText('Alfiqih');
    }

    public function testInputArray()
    {
        $this->post(
            '/input/hello/array',
            [
                "products" =>  [
                    [
                        "name" => "Oppo A37",
                        "price" => 4000000
                    ],
                    [
                        "name" => "Redmi Note 8 Pro",
                        "price" => 4400000
                    ]
                ]
            ]
        )
            ->assertSeeText("Oppo A37")
            ->assertSeeText("Redmi Note 8 Pro");
    }

    public function testInputType()
    {
        $this->post(
            '/input/type',
            [
                "name" => "Momo",
                "married" => "false",
                "birthDate" => "2001-06-18"
            ]
        )
            ->assertSeeText("Momo")
            ->assertSeeText("false")
            ->assertSeeText("2001-06-18");
    }
}
