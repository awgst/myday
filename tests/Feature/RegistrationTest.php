<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    public function testRegisterWithValidData()
    {
        $response = $this->post('register', [
            'name' => "Test",
            'username' => 'test.username',
            'email' => 'test@mail.com',
            'password' => 'testpassword'
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasNoErrors();
        $user = User::find(1);

        $this->actingAs($user);
        $response = $this->get('/');
        $response->assertRedirect('/email/verify');
    }

    public function testRegisterWithInvalidData()
    {
        $response = $this->post('register', [
            'name' => null,
            'username' => null,
            'email' => 'testxxxx',
            'password' => 'tword'
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'username', 'password']);
    }
}
