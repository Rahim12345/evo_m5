<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHomeBannerRequest;
use App\Http\Requests\UpdateHomeBannerRequest;
use App\Models\HomeBanner;

class HomeBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = HomeBanner::orderBy('order_no', 'asc')->where('locale', request('locale'))->get();

        return view('back.pages.home-banner.index', [
            'banners' => $banners,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.home-banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHomeBannerRequest $request)
    {
        $src = $request->file('src');
        $imageName = time() . '.' . $src->getClientOriginalExtension();
        $src->move(public_path('files/home_banners'), $imageName);

        HomeBanner::create([
            'locale' => $request->locale,
            'src' => $imageName,
            'alt' => $request->alt,
            'main_heading' => $request->main_heading,
            'title' => $request->title,
            'intro_text' => $request->intro_text,
            'button_text_1' => $request->button_text_1,
            'button_text_2' => $request->button_text_2,
            'button_link_1' => $request->button_link_1,
            'button_link_2' => $request->button_link_2,
            'order_no' => $request->order_no ?? 0,
        ]);

        return redirect()->route('home-banner.index')->with('success', 'Banner uğurla əlavə edildi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeBanner $homeBanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeBanner $homeBanner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHomeBannerRequest $request, HomeBanner $homeBanner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeBanner $homeBanner)
    {
        //
    }
}
