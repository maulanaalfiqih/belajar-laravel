<?php

namespace App\Services;

use Illuminate\Support\Facades\App;



interface HelloService
{
    public function hello(string $name): string;
}
