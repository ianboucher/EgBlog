<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testPostCreation()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(factory(User::class)->create())
                    ->visit('/posts/create')
                    ->assertSee('Create a Post')
                    ->type('#title', 'Test Post')
                    ->type('#body', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')
                    ->press('Submit')
                    ->assertPathIs('/posts')
                    ->assertSee('Test Post');
        });
    }
}
