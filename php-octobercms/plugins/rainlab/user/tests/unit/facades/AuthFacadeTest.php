<?php namespace RainLab\User\Tests\Unit\Facades;

use Auth;
use RainLab\User\Models\User;
use RainLab\User\Tests\PluginTestCase;

class AuthFacadeTest extends PluginTestCase
{
    public function test_registering_a_user()
    {
        // register a user
        $user = Auth::register([
            'name' => 'Some User',
            'email' => 'some@website.tld',
            'password' => 'changeme',
            'password_confirmation' => 'changeme',
        ]);

        // our one user should be returned
        $this->assertEquals(1, User::count());
        $this->assertInstanceOf('RainLab\User\Models\User', $user);
        
        // and that user should have the following data
        $this->assertFalse($user->is_activated);
        $this->assertEquals('Some User', $user->name);
        $this->assertEquals('some@website.tld', $user->email);
    }

    public function test_registering_a_user_with_auto_activation()
    {
        // register a user with the auto-activate flag
        $user = Auth::register([
            'name' => 'Some User',
            'email' => 'some@website.tld',
            'password' => 'changeme',
            'password_confirmation' => 'changeme',
        ], true);

        // that user should be activated
        $this->assertTrue($user->is_activated);

        // and we should now be authenticated
        $this->assertTrue(Auth::check());
    }

    public function test_registering_a_guest()
    {
        // register a guest
        $guest = Auth::registerGuest(['email' => 'person@acme.tld']);

        // our one guest should be returned
        $this->assertEquals(1, User::count());
        $this->assertInstanceOf('RainLab\User\Models\User', $guest);

        // and that guest should have the following data
        $this->assertTrue($guest->is_guest);
        $this->assertEquals('person@acme.tld', $guest->email);
    }

    public function test_login_and_checking_authentication()
    {
        // we should not be authenticated
        $this->assertFalse(Auth::check());

        // create a user
        $user = User::create([
            'name' => 'Some User',
            'email' => 'some@website.tld',
            'password' => 'changeme',
            'password_confirmation' => 'changeme',
        ]);

        // in order to log in as this user, we must be activated
        $user->is_activated = true;
        $user->activated_at = now();
        $user->save();

        // log in as a new user
        Auth::login($user);

        // we should now be authenticated
        $this->assertTrue(Auth::check());
    }
}