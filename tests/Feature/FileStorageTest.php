<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class FileStorageTest extends TestCase
{
    public function testStorage()
    {
        $filesystem = Storage::disk("local");

        $filesystem->put("file.txt", "Halo momo ganteng");

        $content = $filesystem->get("file.txt");

        self::assertEquals("Halo momo ganteng", $content);
    }

    public function testStoragePublic()
    {
        $filesystem = Storage::disk("public");

        $filesystem->put("file.txt", "Halo momo ganteng - public");

        $content = $filesystem->get("file.txt");

        self::assertEquals("Halo momo ganteng - public", $content);
    }
}
