<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Instructor;
use App\Models\Service;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {
        $services = Service::orderBy('order_no', 'asc')->where('locale', app()->getLocale())->get();

        $about = About::where('locale', app()->getLocale())->first();

        $instructors = Instructor::where('locale', app()->getLocale())
            ->orderBy('order_no', 'asc')
            ->take(4)
            ->get();

        return view('front.pages.about', [
            'about' => $about,
            'services' => $services,
            'instructors' => $instructors,
        ]);
    }
}
