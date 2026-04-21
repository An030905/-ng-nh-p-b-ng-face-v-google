<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class FacebookController extends Controller
{
    /**
     * Chuyển hướng người dùng sang Facebook
     */
    public function redirectToFacebook()
{
    return Socialite::driver('facebook')->stateless()->redirect();
}

    /**
     * Xử lý dữ liệu trả về từ Facebook
     */
    public function handleFacebookCallback(Request $request)
{
    try {
        $facebookUser = Socialite::driver('facebook')->stateless()->user();
        $email = $facebookUser->email;
        $avatar = $facebookUser->avatar ? substr($facebookUser->avatar, 0, 250) : null;

        $user = User::where('provider', 'facebook')
            ->where('provider_id', $facebookUser->id)
            ->first();

        if (! $user && $email) {
            $user = User::where('email', $email)->first();
        }

        if ($user) {
            $user->update([
                'name' => $facebookUser->name ?: $user->name,
                'avatar' => $avatar,
                'provider' => 'facebook',
                'provider_id' => $facebookUser->id,
                'student_id' => $user->student_id ?: '23810310263',
                'email' => $email ?: $user->email,
            ]);

            Auth::login($user, true);
        } else {
            $user = User::create([
                'name' => $facebookUser->name ?: 'Facebook User',
                'email' => $email ?: 'facebook_'.$facebookUser->id.'@no-email.local',
                'student_id' => '23810310263',
                'avatar' => $avatar,
                'provider' => 'facebook',
                'provider_id' => $facebookUser->id,
                'password' => bcrypt('123456dummy'),
            ]);

            Auth::login($user, true);
        }

        $request->session()->regenerate();
        $request->session()->put('oauth_provider', 'facebook');
        $request->session()->put('oauth_user', [
            'name' => $user->name,
            'email' => $user->email,
            'student_id' => $user->student_id,
            'avatar' => $user->avatar,
        ]);

        return redirect()->intended('dashboard'); 
        
    } catch (\Exception $e) {
        Log::error('Facebook login failed', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return redirect('/login-choice')->with('error', 'Đăng nhập Facebook thất bại: '.$e->getMessage());
    }
}
}
