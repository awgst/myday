<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * List of providers configured in config/services acts as whitelist
     *
     * @var array
     */
    protected $providers = [
        'google'
    ];

    /**
     * Redirect to provider for authentication
     *
     * @param $driver
     * @return mixed
     */
    public function authRedirect($driver) {
        if (!$this->isProviderAllowed($driver)) {
            return $this->failedResponse('Provider is not allowed.');
        }
        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            return $this->failedResponse($e->getMessage());
        }
    }

    /**
     * Handle response of authentication redirect
     *
     * @param $driver
     * @return redirect
     */
    public function authCallback($driver) {
        try {
            // Get user Information from provider
            $providerUser = Socialite::driver($driver)->user();
            // Get user information from database
            $user = User::where('email', $providerUser->getEmail())->first();
            if($user){
                // Update user information in database if user is exists
                $user->update([
                    'name' => $providerUser->getName(),
                    'provider_id' => $providerUser->getId(),
                    'provider' => $driver,
                ]);
            }
            else{
                // Create new one
                $user = User::create([
                    'name' => $providerUser->getName(),
                    'username' => $providerUser->getEmail(),
                    'email' => $providerUser->getEmail(),
                    'provider' => $driver,
                    'provider_id' => $providerUser->getId(),
                    'password' => 'password'
                ]);
                $user->email_verified_at = now();
                $user->save();
            }
            Auth::login($user);
            return redirect('/');
        } catch (Exception $e) {
            return $this->failedResponse($e->getMessage());
        }
    }

    /**
     * Check for provider allowed and services configured
     *
     * @param $driver
     * @return bool
     */
    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }

    /**
     * Send a failed response with a message
     *
     * @param $message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function failedResponse($message) {
        notice('error', $message);
        // notice('error', 'Oops, Somethings went wrong! Please try again later.');
        return redirect()->route('login');
    }
}