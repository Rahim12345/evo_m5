<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Models\Testimonial;
use App\Traits\FileUpload;

class TestimonialController extends Controller
{
    use FileUpload;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::where('locale', request('locale'))->get();

        return view('back.pages.testimonials.index', [
            'testimonials' => $testimonials
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestimonialRequest $request)
    {
        $src = $this->fileSave('files/testimonials/', $request, 'src');

        Testimonial::create([
            'locale' => $request->locale,
            'src' => $src,
            'alt' => $request->alt,
            'name' => $request->name,
            'profession' => $request->profession,
            'review' => $request->review,
            'order_no' => $request->order_no,
        ]);

        return response()->json([
            'message' => 'RƏy uğurla əlavə edildi.',
            'redirect_url' => route('testimonial.index') . '?locale=' . $request->locale
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('back.pages.testimonials.edit', [
            'testimonial' => $testimonial
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        $src = $this->fileUpdate($testimonial->src, $request->hasFile('src'), $request->src, 'files/testimonials/');

        $testimonial->update([
            'locale' => $request->locale,
            'src' => $src,
            'alt' => $request->alt,
            'name' => $request->name,
            'profession' => $request->profession,
            'review' => $request->review,
            'order_no' => $request->order_no,
        ]);

        return response()->json([
            'message' => 'Rəy uğurla yadda saxlanıldı.',
            'redirect_url' => route('testimonial.index') . '?locale=' . $request->locale
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        $this->fileDelete('files/testimonials/' . $testimonial->src);
        $testimonial->delete();

        return response()->json($testimonial);
    }
}
