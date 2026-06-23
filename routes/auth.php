<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Üyelik kapalı
|--------------------------------------------------------------------------
| Frontend tarafında üyelik / kayıt sistemi yoktur. Tüm içerik herkese
| açıktır ve yalnızca yönetici paneli (/admin) kimlik doğrulaması kullanır.
| Aşağıdaki "login" route'u yalnızca framework'ün `auth` middleware'inin
| ihtiyaç duyduğu isimli route'u sağlamak için yönetici girişine yönlendirir.
*/

Route::get('/login', function () {
    return redirect('/admin/login');
})->middleware('guest')->name('login');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
