<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeTest extends TestCase
{
    public function like_test(): void
    {
        $user = new User();
        $user->name = 'Henrik';
        $user->email = 'henrik@yrgo.se';
        $user->password = '123';
        $user->save();

        $this->actingAs($user);

        $this->post('/like', [
            'user_id' => $user->id,
            'resturant_id' => 1,
        ]);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'resturant_id' => 1,
        ]);
    }

    public function already_liked_test(): void
    {
        $user = new User();
        $user->name = 'Henrik';
        $user->email = 'henrik@yrgo.se';
        $user->password = '123';
        $user->save();

        $this->actingAs($user);

        $this->post('/like', [
            'user_id' => $user->id,
            'resturant_id' => 1,
        ]);

        $this->post('/like', [
            'user_id' => $user->id,
            'resturant_id' => 1,
        ]);

        $this->assertDatabaseCount('likes', 1);
    }
}
