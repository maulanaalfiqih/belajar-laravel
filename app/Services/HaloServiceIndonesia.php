<?php

namespace App\Services;

class HaloServiceIndonesia implements HelloService
{

    public function hello(string $name): string
    {
        return "Halo $name";
    }
}
