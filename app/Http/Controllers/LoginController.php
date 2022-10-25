<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class LoginController extends Controller
{
    public function redirectToProvider() {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback() {
        try {
            $user = Socialite::driver('google')->user();
            // dd($user);
            $findUser = User::where('google_id', $user->id)->first();

            if($findUser) {
                Auth::login($findUser);
                return redirect()->route('list');
            }
            else {
                $newUser = User::create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'google_id' => $user['sub'],
                ]);
                Auth::login($newUser);
                return redirect()->route('list');
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect() ->route('list');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('list');
    }
}
