<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use App\Traits\FileUpload;

class CourseController extends Controller
{
    use FileUpload;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Course::query();

        $query->with('getCategory', 'getTeacher');

        if (auth()->user()->role_id != 1) {
            $query->where('teacher_id', auth()->user()->id);
        }

        $courses = $query->where('locale', request('locale'))->get();

        return view('back.pages.course.index', [
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('locale', request('locale'))->get();

        return view('back.pages.course.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $src = $this->fileSave('files/courses/', $request, 'src');

        Course::create([
            'locale' => $request->locale,
            'src' => $src,
            'alt' => $request->alt,
            'name' => $request->name,
            'slug' => str_slug($request->slug),
            'order_no' => $request->order_no,
            'category_id' => $request->category_id,
            'teacher_id' => auth()->user()->id,
        ]);

        return response()->json([
            'message' => 'Kurs uğurla əlavə edildi.',
            'redirect_url' => route('course.index') . '?locale=' . $request->locale
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $categories = Category::where('locale', request('locale'))->get();

        return view('back.pages.course.edit', [
            'course' => $course,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $src = $this->fileUpdate($course->src, $request->hasFile('src'), $request->src, 'files/courses/');

        $course->update([
            'locale' => $request->locale,
            'src' => $src,
            'alt' => $request->alt,
            'name' => $request->name,
            'slug' => str_slug($request->slug),
            'order_no' => $request->order_no,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'message' => 'Kurs uğurla redaktə edildi.',
            'redirect_url' => route('course.index') . '?locale=' . $request->locale
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $this->fileDelete('files/courses/' . $course->src);
        $course->delete();

        return response()->json($course);
    }
}
