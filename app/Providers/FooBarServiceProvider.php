<?php

namespace App\Providers;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HaloServiceIndonesia;
use App\Services\HelloService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        HelloService::class => HaloServiceIndonesia::class
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // echo "FooBarServiceProviderOn"; *line code uji coba deferrable provider
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
    /*function ini adalah penerapan dari deferrable provider 
    yang mana hanya akan menload service provider jika memang dibutuhkan
    */
    public function provides()
    {
        return [HelloService::class, Foo::class, Bar::class];
    }
}
