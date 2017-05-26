<?php

namespace Tests\Unit;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostsTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostHasTitle()
    {
        $post = factory(Post::class)->make([
            'title' => 'Test Title'
        ]);

        $this->assertEquals('Test Title', $post->title);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostHasBody()
    {
        $post = factory(Post::class)->make([
            'body' => 'Test body'
        ]);

        $this->assertEquals('Test body', $post->body);
    }
}
