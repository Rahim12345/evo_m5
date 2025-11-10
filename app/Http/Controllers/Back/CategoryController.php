<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Traits\FileUpload;

class CategoryController extends Controller
{
    use FileUpload;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('locale', request('locale'))->get();

        return view('back.pages.category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $src = $this->fileSave('files/categories/', $request, 'src');

        Category::create([
            'locale' => $request->locale,
            'src' => $src,
            'alt' => $request->alt,
            'name' => $request->name,
            'slug' => str_slug($request->slug),
            'order_no' => $request->order_no,
        ]);

        return response()->json([
            'message' => 'Kateqoriya uğurla əlavə edildi.',
            'redirect_url' => route('category.index') . '?locale=' . $request->locale
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
