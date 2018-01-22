<?php

namespace Tests\Feature;

use App\Post;
use App\Topic;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        Topic::create(['name' => '经典']);
    }
}
