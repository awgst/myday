<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Tests\TestCase;


class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test login page.
     *
     * @return void
     */
    public function testLoginPageIsWorkingCorrectly()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSeeText('Username or email');
        $response->assertSeeText('Sign In');
    }

    /**
     * Test user login
     */
    public function testUserCanLoginWithCorrectCredentials()
    {
        $user = $this->user();
        $password = $this->password;
        $response = $this->post('/login', [
            'username_login' => $user->email,
            'password_login' => $password,
        ]);

        $response->assertRedirect('/');
    }

    /**
     * Test user login when email is not verified yet should be redirected to /email/verify
     */
    public function testUserWithUnverifiedEmailWillBeRedirectedToEmailVerify()
    {
        $user = $this->unverified()->user();
        $this->actingAs($user);

        $response = $this->get('/');
        $response->assertRedirect('/email/verify');
    }

    /**
     * Test user login with wrong credential
     */
    public function testUserCannotLoginWithWrongCredential()
    {
        $this->user();
        $response = $this->post('/login', [
            'username_login' => 'wrong-email@example.com',
            'password_login' => 'wrongpassword'
        ]);

        $response->assertSessionHas(['notice'], ['Sign in failed, please try again']);
        $response->assertSessionHasErrors(['email']);
    }
}
