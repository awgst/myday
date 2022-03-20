<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;
use Tests\CreatesApplication;
use Tests\TestCase;

class RegisterTest extends BaseTestCase
{
    use CreatesApplication;
    public $baseUrl = '';

    public function testRegisterPageIsWorkingCorrectly()
    {
        $this->visit('/login')
            ->click('nav-sign-up-tab')
            ->see('Register');
    }
}
