<?php

use App\Http\Controllers\Back\AboutController as BackAboutController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\HomeBannerController;
use App\Http\Controllers\Back\InstructorController;
use App\Http\Controllers\Back\ServiceController;
use App\Http\Controllers\Back\TestimonialController;
use App\Http\Controllers\Front\AboutController as FrontAboutController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\CourseController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\SingleController;
use App\Http\Controllers\SubscribeController;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;


Route::get('qr-test', function () {
    $qr = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(300)->generate('https://evo_m5.test/qr-test');


    $filename = 'qr_' . 2 . '.png';
    Storage::disk('public')->put('qr/' . $filename, $qr);
});

Route::get('/locale/{locale}', function ($locale) {
    session()->put('locale', $locale);

    return redirect()->back();
})->name('locale');

Route::group(['middleware' => ['visitor', 'locale']], function () {
    Route::get('/', [HomeController::class, 'home'])->name('front.home');
    Route::get('/haqqimizda', [FrontAboutController::class, 'about'])->name('front.about');
    Route::get('/elaqe', [ContactController::class, 'contact'])->name('front.contact');
    Route::post('/elaqe', [ContactController::class, 'contactPost'])->name('front.contact.post');
    Route::get('/kurslar', [CourseController::class, 'courses'])->name('front.courses');

    Route::post('subscribe', [SubscribeController::class, 'store'])->name('front.subscribe.store');
});

Auth::routes([
    'reset' => false,
    'verify' => false,
]);

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth'], 'as' => 'custom_namespace.'], function () {
    Lfm::routes();
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('back.dashboard');

    Route::group(['middleware' => 'admin'], function () {
        Route::resource('home-banner', HomeBannerController::class);
        Route::resource('services', ServiceController::class);
        Route::get('subscriber', [SubscribeController::class, 'index'])->name('back.subscriber.index');
        Route::delete('subscriber/{subscriber}', [SubscribeController::class, 'destroy'])->name('back.subscriber.destroy');
        Route::resource('about', BackAboutController::class)->only(['create', 'store']);
        Route::resource('category', CategoryController::class);
        Route::resource('instructor', InstructorController::class);
        Route::resource('testimonial', TestimonialController::class);
        Route::resource('single', SingleController::class);
        Route::get('/contact', [ContactController::class, 'index'])->name('back.contact');
    });

    Route::resource('course', \App\Http\Controllers\Back\CourseController::class);
});
