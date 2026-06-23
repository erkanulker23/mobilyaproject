<?php

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;

Route::get(Lang::uri('services'), [\App\Http\Controllers\Frontend\ServiceController::class, 'index'])
    ->name('services.index');

Route::get(Lang::uri('services/{servicePost:slug}'), [\App\Http\Controllers\Frontend\ServiceController::class, 'showPost'])
    ->name('services.show');

Route::get(Lang::uri('services-category/{serviceCategory:slug}'), [\App\Http\Controllers\Frontend\ServiceController::class, 'showServicesCategory'])
    ->name('services-category.index');
