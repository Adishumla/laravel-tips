<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_view_login_form()
    {
        $response = $this->get('/');
        $response->assertSeeText('Email');
        $response->assertStatus(200);
    }

    use RefreshDatabase;

    public function test_login_user()
    {
        $user = new User();
        $user->name = 'Henrik';
        $user->email = 'Henrik@yrgo.se';
        $user->password = '123';

        //following redirects
        $this->followingRedirects()
            ->post(
                '/',
                [
                    'email' => $user->email,
                    'password' => $user->password
                ]
            )
            ->assertSeeText($user->name)
            ->assertSeeText('Add a Resturant');
    }

    public function test_login_user_without_password()
    {
        $user = new User();
        $user->email = 'Sverker@yrgo.se';

        $response = $this->followingRedirects()
            ->post(
                '/',
                [
                    'email' => $user->email,
                ]
            )
            ->assertSeeText('The provided credentials do not match our records.');
    }

    use RefreshDatabase;

    public function test_logout()
    {
        /* test to logout user */
        $user = new User();
        $user->name = 'Henrik';
        $user->email = 'henrik@yrgo.se';
        $user->password = '123';
        $user->save();

        /* acting as */
        $this->actingAs($user);
        /* login */
        $this->followingRedirects()
            ->post(
                '/',
                [
                    'email' => $user->email,
                    'password' => $user->password
                ]
            )
            ->assertSeeText($user->name)
            ->assertSeeText('Add a Resturant');
        $this->assertTrue(Auth::check());



        /* logout */
        $this->followingRedirects()
            ->get('/logout')
            ->assertSeeText('Login')
            ->assertSeeText('Register');
        $this->assertFalse(Auth::check());
    }
}
