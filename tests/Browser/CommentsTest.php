<?php

namespace Tests\Browser;

use App\User;
use App\Post;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CommentsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCommentCreation()
    {
        $post = factory(Post::class)->create();

        $this->browse(function (Browser $browser) use ($post) {
            $browser->loginAs(factory(User::class)->create())
                    ->visit('/posts/' . $post->id)
                    ->assertSee($post->title)
                    ->type('body', 'This is a test comment, courtesy of Dusk')
                    ->press('Submit')
                    ->assertPathIs('/posts/' . $post->id)
                    ->assertSee('This is a test comment, courtesy of Dusk');
        });
    }
}
