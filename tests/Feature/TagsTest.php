<?php

namespace Tests\Feature;

use App\Tag;
use App\Post;
use Illuminate\Database\QueryException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTagAssociatedWithPost()
    {
        $post = factory(Post::class)->create();
        $tag  = factory(Tag::class)->create();

        $post->tags()->attach($tag);
        $tagFromDB = Post::find($post->id)->tags()->first();

        $this->assertEquals($tagFromDB->id, $tag->id);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTagDissassociatedFromPost()
    {
        $post = factory(Post::class)->create();
        $tag  = factory(Tag::class)->create();
        $post->tags()->attach($tag);

        $post->tags()->detach($tag);

        $this->assertEquals($post->tags()->first(), null);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTagCannotBeAssociatedWithSamePostTwice()
    {
        $this->expectException(QueryException::class);

        $post = factory(Post::class)->create();
        $tag  = factory(Tag::class)->create();

        $post->tags()->attach($tag);
        $post->tags()->attach($tag);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTagDeletedFromDatabase()
    {
        $tag  = factory(Tag::class)->create();
        $tag->delete();

        $this->assertEquals(Tag::find($tag->id), null);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDeletedTagIsNotAssociatedWithPost()
    {
        $post = factory(Post::class)->create();
        $tag  = factory(Tag::class)->create();

        $post->tags()->attach($tag);
        $tag->delete();

        $postFromDB = Post::find($post->id);

        $this->assertEquals($postFromDB->tags()->first(), null);
    }
}
