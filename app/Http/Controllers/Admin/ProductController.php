<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.products.index', [
            'products' => Product::with(['category', 'brand', 'images'])
                ->latest()
                ->orderBy('id')
                ->paginate(10)
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
    public function show(Product $product)
    {
        return view('admin.products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view(
            'admin.products.edit',
            [
                'product' => $product,
                'categories' => Category::get(),
                'brands' => Brand::get()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    protected function handleGenerateUniqueFilename($request, ImageManager $manager)
    {
        if (!$request->hasFile('images')) {
            return [];
        }
        $filenames = [];
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

            $filenames[] = $filename;
        }
        return $filenames;
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $manager = new ImageManager(new Driver());
        $data = $request->validated();

        unset(
            $data['images'],
            $data['delete_images'],
            $data['user_id']
        );

        if ($data['condition'] === 'new') {
            $data['sale_percent'] = null;
        }

        $oldImageCount = $product->images()->count();

        $deleteImageCount = is_array($request->delete_images)
            ? count($request->delete_images)
            : 0;

        $newImageCount = $request->file('images')
            ? count($request->file('images'))
            : 0;

        if ($oldImageCount - $deleteImageCount + $newImageCount > 3) {
            return redirect()
                ->back()
                ->withErrors([
                    'images' => 'You can upload a maximum of 3 images per product.'
                ])
                ->withInput();
        }

        if ($request->filled('delete_images')) {
            $images = $product->images()
                ->whereIn('id', $request->delete_images)
                ->get();

            foreach ($images as $img) {
                Storage::disk('public')->delete([
                    'products/85x84/' . $img->image,
                    'products/329x380/' . $img->image,
                    'products/full/' . $img->image,
                ]);
                $img->delete();
            }
        }

        $filenames = $this->handleGenerateUniqueFilename($request, $manager);

        if (!empty($filenames)) {
            $product->images()->createMany(
                collect($filenames)
                    ->map(fn($filename) => [
                        'image' => $filename
                    ])
                    ->toArray()
            );
        }

        $product->update($data);

        return redirect()
            ->route('admin.products')
            ->with(
                'success',
                'Product updated successfully'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        foreach ($product->images as $img) {
            Storage::disk('public')->delete([
                'products/85x84/' . $img->image,
                'products/329x380/' . $img->image,
                'products/full/' . $img->image,
            ]);
            $img->delete();
        }

        $product->delete();

        return redirect()
            ->route('admin.products')
            ->with('success', 'Product deleted successfully');
    }
}
