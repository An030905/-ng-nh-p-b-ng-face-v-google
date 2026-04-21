<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
{
    try {
        $googleUser = Socialite::driver('google')->user();
        $user = User::where('email', $googleUser->email)->first();

        if ($user) {
            $user->update([
                'name' => $googleUser->name,
                'avatar' => $googleUser->avatar,
                'provider' => 'google',
                'provider_id' => $googleUser->id,
                'student_id' => $user->student_id ?: '23810310263',
            ]);

            Auth::login($user);
        } else {
            $newUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'student_id' => '23810310263',
                'avatar' => $googleUser->avatar,
                'provider' => 'google',
                'provider_id' => $googleUser->id,
                'password' => bcrypt('123456dummy'),
            ]);

            Auth::login($newUser);
        }

        return redirect()->intended('dashboard');
    } catch (Exception $e) {
        return redirect('/auth/google')->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
    }
}
    public function logout()
{
    Auth::logout();
    return redirect('/auth/google');
}
}
