<?php

namespace Tests\Unit;

use App\Tag;
use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagsTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTagCreation()
    {
        $tag = factory(Tag::class)->make();

        $this->assertInstanceOf(Tag::class, $tag);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTagHasName()
    {
        $tag = factory(Tag::class)->make([
            'name' => 'Testname',
        ]);

        $this->assertEquals($tag->name, 'Testname');
    }
}
