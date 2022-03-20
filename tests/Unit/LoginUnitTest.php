<?php

namespace Tests\Unit;

use App\Http\Controllers\Auth\LoginController;
use Tests\TestCase;
use Illuminate\Support\Str;

class LoginUnitTest extends TestCase
{
    /**
     * Test for check return of username is an email or username
     */
    public function testReturnUsernameIfInputIsUsername()
    {
        $loginController = new LoginController();
        $faker = \Faker\Factory::create();
        request()->merge(['username_login'=> $faker->userName, 'password_login'=>Str::random(8)]);
        $return = $loginController->username();

        $this->assertTrue($return === 'username');
    }

    /**
     * Test for check return of username is an email or username
     */
    public function testReturnEmailIfInputIsEmail()
    {
        $loginController = new LoginController();
        $faker = \Faker\Factory::create();
        request()->merge(['username_login' => $faker->safeEmail, 'password_login'=>Str::random(8)]);
        $return = $loginController->username();

        $this->assertTrue($return === 'email');
    }
}
