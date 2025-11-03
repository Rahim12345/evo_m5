<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $banners = HomeBanner::orderBy('order_no', 'asc')->where('locale', app()->getLocale())->get();

        return view('front.pages.home', [
            'banners' => $banners,
        ]);
    }
}
