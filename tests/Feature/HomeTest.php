<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;
use Tests\CreatesApplication;
use Illuminate\Support\Str;
use App\Models\User;

class HomeTest extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;
    public $baseUrl = '';
    protected $unverified = false;
    
    public function testHomePageShowedCorrectly()
    {
        $user = $this->user();
        $this->actingAs($user)
            ->visit('/')
            ->see('Hi, '.explode(' ', $user->name)[0]);
    }

    // Generate user
    protected function user()
    {
        $password = Str::random(8);
        if ($this->unverified) {
            $user = User::factory(1)
                        ->unverified()
                        ->create([
                            'password' => bcrypt($password)
                        ])->first();
        } else {
            $user = User::factory(1)->create([
                'password' => bcrypt($password)
            ])->first();
        }
        
        $this->password = $password;
        return $user;
    }
}
