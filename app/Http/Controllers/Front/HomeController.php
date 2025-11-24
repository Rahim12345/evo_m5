<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Course;
use App\Models\HomeBanner;
use App\Models\Instructor;
use App\Models\Service;

class HomeController extends Controller
{
    public function home()
    {
        $banners = HomeBanner::orderBy('order_no', 'asc')->where('locale', app()->getLocale())->get();

        $services = Service::orderBy('order_no', 'asc')->where('locale', app()->getLocale())->get();

        $about = About::where('locale', app()->getLocale())->first();

        $categories = Category::where('locale', app()->getLocale())->take(4)->get();

        $courses = Course::with('getCategory', 'getTeacher')
            ->where('locale', app()->getLocale())
            ->take(3)
            ->get();

        $instructors = Instructor::where('locale', app()->getLocale())
            ->orderBy('order_no', 'asc')
            ->take(4)
            ->get();

        return view('front.pages.home', [
            'banners' => $banners,
            'services' => $services,
            'about' => $about,
            'categories' => $categories,
            'courses' => $courses,
            'instructors' => $instructors
        ]);
    }
}
