<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::get('register', [RegisteredUserController::class, 'register'])
    ->middleware('guest');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware(['guest',  \Spatie\Honeypot\ProtectAgainstSpam::class])
    ->name('register');

Route::get('/login', [AuthenticatedSessionController::class, 'login'])
    ->middleware('guest');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware(['guest', \Spatie\Honeypot\ProtectAgainstSpam::class])
    ->name('login');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'forgot'])
    ->middleware('guest');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware(['guest', \Spatie\Honeypot\ProtectAgainstSpam::class])
    ->name('password.email');

Route::get('/password-reset/{token}', [NewPasswordController::class, 'reset'])
    ->name('password.reset')
    ->middleware('guest');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.store');

Route::get('/email/verify', function () {
    flash()->addInfo('Lütfen e-posta adresinizi doğrulayın.', 'Doğrulama');

    return redirect()->route('home');
})->middleware('auth')->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
