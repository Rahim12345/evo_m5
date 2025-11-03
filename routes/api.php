<?php

use App\Http\Controllers\API\HomeBannerController;
use Illuminate\Support\Facades\Route;

Route::get('/home-banner/{locale}', [HomeBannerController::class, 'getBanners']);
