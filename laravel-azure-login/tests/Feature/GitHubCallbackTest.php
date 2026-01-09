<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User;
use Tests\TestCase;

class GitHubCallbackTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_login_with_github(): void
    {
        Socialite::fake('github', (new User)->map([
            'id' => '74825744',
            'name' => 'Gabriel Favero Hoffmann',
            'email' => 'gabriel290974@gmail.com'
        ])->setToken('fake-token')
            ->setRefreshToken('fake-refresh-token')
            ->setExpiresIn(3600)
            ->setApprovedScopes(['read', 'write']));

        $response = $this->get('auth/github/callback');

        $response->assertRedirect();

        // $this->assertDatabaseHas('users', [
        //     'name' => 'Gabriel'
        // ])
    }
}
