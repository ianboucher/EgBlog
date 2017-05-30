<?php

namespace Tests\Feature;

use App\Like;
use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LikesTest extends TestCase
{
    use DatabaseMigrations;

    protected $post;
    protected $user;

    /**
     * Set up the conditions for the following tests
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        // Given I have a post and an authenticated user...
        $this->post = factory(Post::class)->create();
        $this->signIn();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanLikeAPost()
    {
        // when that user 'likes' a Post
        $this->post->like();

        // then I should see evidence in the database that the Post has been 'Liked'
        $this->assertEquals(count(Post::find($this->post->id)->likes), 1);
        $this->assertTrue($this->post->isLiked());
        $this->assertDatabaseHas('likes', [
            'user_id'       => $this->user->id,
            'likeable_id'   => $this->post->id,
            'likeable_type' => get_class($this->post)
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanUnlikeAPost()
    {
        $this->post->like();
        $this->post->unlike();

        $this->assertEquals(count(Post::find($this->post->id)->likes), 0);
        $this->assertFalse($this->post->isLiked());
        $this->assertDatabaseMissing('likes', [
            'user_id'       => $this->user->id,
            'likeable_id'   => $this->post->id,
            'likeable_type' => get_class($this->post)
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanToggleLikeStatusForPost()
    {
        $this->post->toggleLike();
        $this->assertTrue($this->post->isLiked());

        $this->post->toggleLike();
        $this->assertFalse($this->post->isLiked());
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLikeCountCanBeRetrievedFromPost()
    {
        $this->post->like();

        $this->assertEquals($this->post->likesCount, 1);
    }
}
