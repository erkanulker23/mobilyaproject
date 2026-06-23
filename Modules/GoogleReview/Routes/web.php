<?php

use Illuminate\Support\Facades\Route;
use Modules\GoogleReview\Http\Controllers\GoogleReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('google-reviews')->group(function () {
    Route::get('/', [GoogleReviewController::class, 'index'])->name('googlereview.index');
    Route::get('/widget/{id}', [GoogleReviewController::class, 'widget'])->name('googlereview.widget');
});

