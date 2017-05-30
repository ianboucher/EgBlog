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

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanLikeAPost()
    {
        // given I have an authenticated user and a post
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user); // allows test to simulate authenticated user

        // when that user 'likes' a Post
        $post->like();

        // then I should see evidence in the database that the Post has been 'Liked'
        $this->assertEquals(count(Post::find($post->id)->likes), 1);
        $this->assertTrue($post->isLiked());
        $this->assertDatabaseHas('likes', [
            'user_id'       => $user->id,
            'likeable_id'   => $post->id,
            'likeable_type' => get_class($post)
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanUnlikeAPost()
    {
        // given I have an authenticated user and a post
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user); // allows test to simulate authenticated user

        // when that user 'likes' and then 'unlikes' a Post
        $post->like();
        $post->unlike();

        // then I should see evidence in the database that the Post has been 'Liked'
        $this->assertEquals(count(Post::find($post->id)->likes), 0);
        $this->assertFalse($post->isLiked());
        $this->assertDatabaseMissing('likes', [
            'user_id'       => $user->id,
            'likeable_id'   => $post->id,
            'likeable_type' => get_class($post)
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanToggleLikeStatusForPost()
    {
        // given I have an authenticated user and a post
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user); // allows test to simulate authenticated user

        // when that user 'likes' and then 'unlikes' a Post
        $post->toggleLike();

        // then I should see evidence in the database that the Post has been 'Liked'
        $this->assertTrue($post->isLiked());

        // and vice-versa
        $post->toggleLike();

        $this->assertFalse($post->isLiked());
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLikeCountCanBeRetrievedFromPost()
    {
        // given I have an authenticated user and a post
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user); // allows test to simulate authenticated user

        // when that user 'likes' and then 'unlikes' a Post
        $post->like();

        // then I should see evidence in the database that the Post has been 'Liked'
        $this->assertEquals($post->likesCount, 1);

    }
}
