<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use App\Http\Requests\StoreSubscribeRequest;
use App\Http\Requests\UpdateSubscribeRequest;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request('search')) {
            $subscribes = Subscribe::where('email', 'like', '%' . request('search') . '%')->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $subscribes = Subscribe::orderBy('created_at', 'desc')->paginate(10);
        }

        return view('back.pages.subscribe.index', [
            'subscribes' => $subscribes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscribeRequest $request)
    {
        Subscribe::create([
            'email' => $request->email
        ]);

        return response()->json([
            'success_title' => __('static.success_title'),
            'subscribe_text' => __('static.subscribe_text'),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscribe $subscribe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscribe $subscribe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscribeRequest $request, Subscribe $subscribe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subscribe = Subscribe::where('id', $id)->firstOrFail();

        $subscribe->delete();

        return redirect()->back()->with('success', __('static.delete_success'));
    }
}
