<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Str;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $password;
    private $unverified;

    protected function unverified()
    {
        $this->unverified = true;
        return $this;
    }

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
