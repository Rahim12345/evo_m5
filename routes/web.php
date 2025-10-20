<?php

use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\HomeBannerController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\CourseController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/locale/{locale}', function ($locale) {
    session()->put('locale', $locale);

    return redirect()->back();
})->name('locale');

Route::group(['middleware' => ['visitor', 'locale']], function () {
    Route::get('/', [HomeController::class, 'home'])->name('front.home');
    Route::get('/haqqimizda', [AboutController::class, 'about'])->name('front.about');
    Route::get('/elaqe', [ContactController::class, 'contact'])->name('front.contact');
    Route::get('/kurslar', [CourseController::class, 'courses'])->name('front.courses');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('back.dashboard');
    Route::resource('home-banner', HomeBannerController::class);
});
