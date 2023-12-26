<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $socialiteUser = Socialite::driver('google')->user();
            $email = $socialiteUser->email;

            $user = User::firstOrCreate(['email' => $email], [
                'name' => $socialiteUser->name,
            ]);

            Auth::login($user);

            return redirect()->route('top');
        } catch (Exception $e) {
            echo "ログインに失敗しました。", $e->getMessage();
        }
    }
}
