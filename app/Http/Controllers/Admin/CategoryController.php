<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\UpdateCategoryRequest;
use App\Http\Requests\Admin\Countries\StoreCountryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::orderBy('id', 'asc')
                ->latest()
                ->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCountryRequest $request)
    {
        $categoryAttributes = $request->validated();

        Category::create($categoryAttributes);

        return redirect()
            ->route('admin.categories')
            ->with(
                'success',
                'Created category successfully'
            );;
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
        return view('admin.categories.edit', compact(
            'category'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data =  $request->validated();

        $category->update($data);

        return redirect()
            ->route('admin.categories')
            ->with(
                'success',
                'Updated category successfully'
            );;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->deleteOrFail();

        return redirect()
            ->route('admin.categories')
            ->with(
                'success',
                'Deleted category successfully'
            );;
    }
}
