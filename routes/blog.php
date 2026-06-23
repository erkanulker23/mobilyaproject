<?php

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;

Route::get(Lang::uri('blog'), [\App\Http\Controllers\Frontend\BlogController::class, 'index'])
    ->name('blog.index');

Route::get(Lang::uri('blog/{post:slug}'), [\App\Http\Controllers\Frontend\BlogController::class, 'showPost'])
    ->name('blog.post.show');

// Blog yorumları
Route::post(Lang::uri('blog/{post:slug}/comments'), [\App\Http\Controllers\Frontend\BlogCommentController::class, 'store'])
    ->name('blog.comments.store');

Route::get(Lang::uri('blog/{post:slug}/comments'), [\App\Http\Controllers\Frontend\BlogCommentController::class, 'index'])
    ->name('blog.comments.index');

// Blog paylaşım takibi
Route::post(Lang::uri('blog/{post:slug}/share'), [\App\Http\Controllers\Frontend\BlogController::class, 'trackShare'])
    ->name('blog.share.track');
