<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
use App\Models\User;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirectToMicrosoft()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function handleGoogleCallback()
    {
        return $this->handleCallback('google');
    }

    public function handleMicrosoftCallback()
    {
        return $this->handleCallback('microsoft');
    }

    public function handleCallback($driver)
    {
        try {
     
            $user = Socialite::driver($driver)->stateless()->user();
      
            $finduser = User::where('social_id', $user->id)->first();

            if ($finduser === null) {
                $finduser = User::where('email', $user->email)->first();
            }
      
            if ($finduser) {
      
                Auth::login($finduser);
     
                return redirect()->route('dashboard');
      
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id'=> $user->id,
                    'social_type'=> $driver,
                    'password' => encrypt("my-{$driver}")
                ]);
     
                Auth::login($newUser);
      
                return redirect()->route('dashboard');
            }
     
        } catch (Exception $e) {
            dd($e);
        }
    }
}
