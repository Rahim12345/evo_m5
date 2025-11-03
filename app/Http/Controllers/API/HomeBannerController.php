<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class HomeBannerController extends Controller
{
    public function getBanners($locale)
    {
        $banners = HomeBanner::orderBy('order_no', 'asc')->where('locale', $locale)->get();

        $banners = $banners->map(function ($banner) {
            $banner->src = asset('files/home_banners/' . $banner->src);
            return $banner;
        });

        return response()->json($banners);
    }
}
