<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_view_register_form()
    {
        $response = $this->get('/register');
        $response->assertSeeText('Register');
        $response->assertStatus(200);
    }

    use RefreshDatabase;

    public function test_register_user()
    {
        $user = new User();
        $user->name = 'Henrik';
        $user->email = 'Henrik@yrgo.se';
        $user->password = '123';

        //following redirects
        $this->post(
            '/register',
            [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                //'password_confirmation' => $user->password
            ]
        );
        $this->assertDatabaseHas('users', ['name' => $user->name]);
    }
}
