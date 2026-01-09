<?php

namespace Tests\Feature;

use Tests\TestCase;
use Laravel\Socialite\Facades\Socialite;

class GithubAuthTest extends TestCase
{
    public function test_user_is_redirected_to_github(): void
    {
        Socialite::fake('github');

        $response = $this->get('/auth/github');

        $response->assertRedirect();
    }
}
