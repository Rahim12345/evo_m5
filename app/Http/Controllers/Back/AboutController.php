<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAboutRequest;
use App\Http\Requests\UpdateAboutRequest;
use App\Models\About;
use App\Traits\FileUpload;

class AboutController extends Controller
{
    use FileUpload;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $about = About::where('id', 1)->first();

        return view('back.pages.about.create',[
            'about' => $about,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAboutRequest $request)
    {
        $about = About::where('id', 1)->first();

        if ($about) {
            $src = $this->fileUpdate($about->src, $request->hasFile('src'), $request->src, 'files/about/');

            $about->update([
                'title' => $request->title,
                'description' => $request->description,
                'src' => $src,
                'alt' => $request->alt,
            ]);
        } else {
            $src = $this->fileSave('files/about/', $request, 'src');

            $about = About::create([
                'title' => $request->title,
                'description' => $request->description,
                'src' => $src,
                'alt' => $request->alt,
            ]);
        }

        return redirect()->route('about.create', $about->id)->with('success', 'Haqqımızda məlumatlar yükləndi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAboutRequest $request, About $about)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        //
    }
}
