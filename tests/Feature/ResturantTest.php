<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ResturantTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_create_resturant()
    {
        /* user */
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

        $this->actingAs($user)
            ->post(
                '/resturant',
                [
                    'category_id' => 1,
                    'user_id' => 1,
                    'price_id' => 1,
                    'city' => 'Stockholm',
                    'name' => 'Test Resturant',
                    'description' => 'Test Resturant Description',
                    'likes' => 0,
                ]
            );
        $this->assertDatabaseHas('resturants', ['name' => 'Test Resturant']);
    }
}
