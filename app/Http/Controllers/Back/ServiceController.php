<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('order_no', 'asc')->where('locale', request('locale'))->get();

        return view('back.pages.services.index', [
            'services' => $services,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        Service::create([
            'locale' => $request->locale,
            'icon' => $request->icon,
            'title' => $request->title,
            'description' => $request->description,
            'order_no' => $request->order_no ?? 0,
        ]);

        return redirect()->route('services.index', ['locale' => $request->locale])->with('success', 'Xidmət uğurla əlavə edildi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('back.pages.services.edit', [
            'service' => $service,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $service->update([
            'locale' => $request->locale,
            'icon' => $request->icon,
            'title' => $request->title,
            'description' => $request->description,
            'order_no' => $request->order_no ?? 0,
        ]);

        return redirect()->route('services.index', ['locale' => $request->locale])->with('success', 'Xidmət uğurla dəyişdirildi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index', ['locale' => $service->locale])->with('success', 'Xidmət uğurla silindi.');
    }
}
