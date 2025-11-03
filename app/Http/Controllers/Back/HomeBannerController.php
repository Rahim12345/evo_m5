<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHomeBannerRequest;
use App\Http\Requests\UpdateHomeBannerRequest;
use App\Models\HomeBanner;
use App\Traits\FileUpload;

class HomeBannerController extends Controller
{
    use FileUpload;

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
        $src = $this->fileSave('files/home_banners/', $request, 'src');

        HomeBanner::create([
            'locale' => $request->locale,
            'src' => $src,
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

        return redirect()->route('home-banner.index', ['locale' => $request->locale])->with('success', 'Banner uğurla əlavə edildi.');
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
        return view('back.pages.home-banner.edit', [
            'homeBanner' => $homeBanner,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHomeBannerRequest $request, HomeBanner $homeBanner)
    {
        $src = $this->fileUpdate($homeBanner->src, $request->hasFile('src'), $request->src, 'files/home_banners/');

        $homeBanner->update([
            'locale' => $request->locale,
            'src' => $src,
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

//        dd($request->post());
        if ($request->has('save_to_list')) {
            return redirect()->route('home-banner.index', ['locale' => $request->locale])->with('success', 'Banner uğurla dəyişdirildi.');
        } else {
            return redirect()->route('home-banner.edit', ['locale' => $request->locale, 'home_banner' => $homeBanner->id])->with('success', 'Banner uğurla dəyişdirildi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $homeBanner = HomeBanner::findOrFail($id);

        $this->fileDelete('files/home_banners/' . $homeBanner->src);

        $homeBanner->delete();
        return redirect()->route('home-banner.index', ['locale' => $homeBanner->locale])->with('success', 'Banner uğurla silindi.');
    }
}
