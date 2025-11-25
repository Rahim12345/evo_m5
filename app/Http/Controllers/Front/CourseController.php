<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function courses()
    {
        $categories = Category::where('locale', app()->getLocale())->take(4)->get();

        $courses = Course::with('getCategory', 'getTeacher')
            ->where('locale', app()->getLocale())
            ->take(3)
            ->get();

        $instructors = Instructor::where('locale', app()->getLocale())
            ->orderBy('order_no', 'asc')
            ->take(4)
            ->get();

        return view('front.pages.courses', [
            'categories' => $categories,
            'courses' => $courses,
            'instructors' => $instructors,
        ]);
    }
}
