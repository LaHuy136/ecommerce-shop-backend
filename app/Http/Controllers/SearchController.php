<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Search By Name and Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = [];
        if ($request->filled('name')) {
            $products = Product::query()
                ->with(['category', 'brand', 'images'])
                ->where('name', 'LIKE', '%' . $request->name . '%')
                ->paginate(6);
        }

        return view('frontend.products.home', [
            'products' => $products,
            'categories' => Category::get(),
            'brands' => Brand::get()
        ]);
    }
    /**
     * Search Advanced and Display a listing of the resource.
     */
    public function search(Request $request)
    {
        $query = Product::query()
            ->with(['category', 'brand', 'images']);


        if ($request->filled('name')) {
            $query->where(
                'name',
                'LIKE',
                '%' . trim($request->name) . '%'
            );
        }

        if ($request->filled('price')) {
            switch ($request->price) {
                case '0-60':
                    $query->where('price', '<', 60);
                    break;

                case '60-200':
                    $query->whereBetween(
                        'price',
                        [60, 200]
                    );
                    break;
            }
        }

        if ($request->filled('category')) {
            $query->where(
                'category_id',
                $request->category
            );
        }

        if ($request->filled('brand')) {
            $query->where(
                'brand_id',
                $request->brand
            );
        }

        $products = $query
            ->paginate(6)
            ->withQueryString();

        return view('frontend.products.home', [
            'products' => $products,
            'categories' => Category::get(),
            'brands' => Brand::get()
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
