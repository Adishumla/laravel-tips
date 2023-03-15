<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_logout_view(): void
    {
        $response = $this->get('/logout');
        $response->assertSeeText('Logout');

        $response->assertStatus(200);
    }
}