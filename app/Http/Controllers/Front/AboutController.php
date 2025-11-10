<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Service;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {
        $services = Service::orderBy('order_no', 'asc')->where('locale', app()->getLocale())->get();

        $about = About::where('locale', app()->getLocale())->first();

        return view('front.pages.about', [
            'about' => $about,
            'services' => $services,
        ]);
    }
}
