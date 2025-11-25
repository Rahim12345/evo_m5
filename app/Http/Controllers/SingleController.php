<?php

namespace App\Http\Controllers;

use App\Models\Single;
use App\Http\Requests\StoreSingleRequest;
use App\Http\Requests\UpdateSingleRequest;

class SingleController extends Controller
{
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
        return view('back.pages.single.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSingleRequest $request)
    {
        foreach ($request->keys() as $key => $name) {
            if ($name != '_token' && $name != 'locale') {
                Single::updateOrCreate(
                    [
                        'key' => $name . '_' . $request->locale
                    ],
                    [
                        'value' => $request->{$name}
                    ]
                );
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Single $single)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Single $single)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSingleRequest $request, Single $single)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Single $single)
    {
        //
    }
}
