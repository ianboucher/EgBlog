<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCreation()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserHasEmail()
    {
        $user = factory(User::class)->create([
            'email' => 'test@user.com'
        ]);

        $this->assertEquals('test@user.com', $user->email);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCheckUserPasswordEncryption()
    {
        $user = factory(User::class)->create(['password' => 'test']);
        $hash = password_hash('test', PASSWORD_DEFAULT);

        $this->assertTrue(password_verify($user->password, $hash));
    }
}
