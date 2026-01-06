<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\Member\StoreProductRequest;
use App\Http\Requests\Member\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.products.index', [
            'products' => Product::orderBy('id')
                ->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'frontend.products.create',
            [
                'categories' => Category::all(),
                'brands' => Brand::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $manager = new ImageManager(new Driver());
        $data = $request->validated();
        unset($data['images']);

        $data['user_id'] = Auth::user()->id;

        $product = Product::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                // Generate a unique filenname.(jpg, png, ...)
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();

                // 85px width image
                $img85 = $manager->read($image)
                    ->resize(85, 84)
                    ->encode();

                Storage::disk('public')
                    ->put("products/85x84/{$filename}", $img85);

                // 329px width image
                $img329 = $manager->read($image)
                    ->resize(329, 380)
                    ->encode();

                Storage::disk('public')
                    ->put("products/329x380/{$filename}", $img329);

                // Full size image
                $image->storeAs(
                    'products/full',
                    $filename,
                    'public'
                );

                $product->images()->create([
                    'image' => $filename
                ]);
            }
        }

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
