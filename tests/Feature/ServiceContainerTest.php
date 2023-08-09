<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testServiceContainer()
    {
        //function make(key) adalah function yang membuat objek baru, sama dengan new Foo()//
        $foo = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals('Foo', $foo->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo, $foo2);
    }

    //bind(key,closure)
    public function testBind()
    {
        //membuat objek baru dengan parameter yang ditentukan
        //jika tidak di bind maka pembuatan objek dengan parameter akan gagal
        //pada bind, new Person() akan dibuat sebanyak objek yang akan dibuat (objek dibuat selalu)
        $this->app->bind(Person::class, function ($app) {
            return new Person("Maulana", "Alfiqih");
        });

        $person = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Maulana', $person->firstname);
        self::assertEquals('Maulana', $person2->firstname);
        self::assertEquals('Alfiqih', $person->lastname);
        self::assertEquals('Alfiqih', $person2->lastname);
        self::assertNotSame($person, $person2); // objek person dan person2 tidak sama
    }

    //singleton(key,closure)
    public function testSingleton()
    {
        //pada singleton, new Person() hanya dibuat satu kali saja. Selanjutnya akan return new Person() atau objek yang sudah ada
        $this->app->singleton(Person::class, function ($app) {
            return new Person("Maulana", "Alfiqih");
        });

        $person = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Maulana', $person->firstname);
        self::assertEquals('Maulana', $person2->firstname);
        self::assertEquals('Alfiqih', $person->lastname);
        self::assertEquals('Alfiqih', $person2->lastname);
        self::assertSame($person, $person2); // objek person dan person2 sama
    }

    //instance(key,objek)
    public function testInstance()
    {
        //instance digunakan ketika ingin membuat objek dari objek yang sudah ada
        $person = new Person('Maulana', 'Alfiqih');
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // engembalikan nilai objek $person
        $person2 = $this->app->make(Person::class); //mengembalikan nilai objek $person

        self::assertEquals('Maulana', $person1->firstname);
        self::assertEquals('Maulana', $person2->firstname);
        self::assertEquals('Alfiqih', $person1->lastname);
        self::assertEquals('Alfiqih', $person2->lastname);
        self::assertSame($person1, $person2);
    }
}
