<?php

use Illuminate\Support\Facades\Route; // Đảm bảo có dòng này ở trên cùng
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FacebookController;
// Đường dẫn để ấn đăng nhập
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);

// Đường dẫn Google trả kết quả về (Callback)
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/dashboard', function () {
    return view('dashboard'); 
})->name('dashboard');

Route::get('/logout', function () {
    Auth::logout();
    request()->session()->forget('oauth_user');
    request()->session()->forget('oauth_provider');
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login-choice'); // Đăng xuất xong quay về trang chọn đăng nhập
});
Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);
Route::get('/login-choice', function () {
    // Bỏ chữ 'auth.' đi vì file không nằm trong thư mục auth
    return view('login-choice'); 
});
