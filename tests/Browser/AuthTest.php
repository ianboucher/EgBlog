<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testExisingUserLogin()
    {
        $user = factory(User::class)->create([
            'email' => 'taylor@laravel.com',
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/posts');
        });
    }

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testNewUserRegistration()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                    ->type('#name', 'Bert')
                    ->type('#email', 'bert@user.com')
                    ->type('#password', 'secret')
                    ->type('#password-confirm', 'secret')
                    ->press('Register')
                    ->assertPathIs('/posts');
        });
    }
}
