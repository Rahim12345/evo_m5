<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;
use App\Models\Instructor;
use App\Traits\FileUpload;

class InstructorController extends Controller
{
    use FileUpload;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructors = Instructor::where('locale', request('locale'))->get();

        return view('back.pages.instructor.index', [
            'instructors' => $instructors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.instructor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstructorRequest $request)
    {
        $src = $this->fileSave('files/instructors/', $request, 'src');

        Instructor::create([
            'locale' => $request->locale,
            'src' => $src,
            'alt' => $request->alt,
            'name' => $request->name,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'x' => $request->x,
            'profession' => $request->profession,
            'order_no' => $request->order_no,
        ]);

        return response()->json([
            'message' => 'Təlimçi uğurla əlavə edildi.',
            'redirect_url' => route('instructor.index') . '?locale=' . $request->locale
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor $instructor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructor $instructor)
    {
        return view('back.pages.instructor.edit', [
            'instructor' => $instructor
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstructorRequest $request, Instructor $instructor)
    {
        $src = $this->fileUpdate($instructor->src, $request->hasFile('src'), $request->src, 'files/instructors/');

        $instructor->update([
            'locale' => $request->locale,
            'src' => $src,
            'alt' => $request->alt,
            'name' => $request->name,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'x' => $request->x,
            'profession' => $request->profession,
            'order_no' => $request->order_no,
        ]);

        return response()->json([
            'message' => 'Təlimçi uğurla əlavə edildi.',
            'redirect_url' => route('instructor.index') . '?locale=' . $request->locale
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor $instructor)
    {
        $this->fileDelete('files/instructors/' . $instructor->src);
        $instructor->delete();

        return response()->json($instructor);
    }
}
