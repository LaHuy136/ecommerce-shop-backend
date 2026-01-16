<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\StoreProductRequest;
use App\Http\Requests\Member\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ProductController extends Controller
{
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' =>  Product::orderBy('id', 'asc')
                ->whereIn('user_id', [Auth::user()->id])
                ->paginate(5)
        ], 200);
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
    public function store(StoreProductRequest $request)
    {
        $manager = new ImageManager(new Driver());
        $data = $request->validated();
        unset($data['images']);

        $data['user_id'] = Auth::user()->id;

        $product = Product::create($data);

        $filenames = $this->handleGenerateUniqueFilename($request, $manager);

        $product->images()->createMany(
            collect($filenames)
                ->map(fn($filename) => [
                    'image' => $filename
                ])
                ->toArray()
        );

        return response()->json([
            'status' => 200,
            'message' => 'Product created successfully',
            'data' => $product->load('images'),
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findorFail($id);

        if ($product->user_id !== Auth::user()->id) {
            abort(403, 'Unauthorized');
        }

        return response()->json([
            'status' => 200,
            'data' => $product->load('images'),
        ], 200);
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
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $manager = new ImageManager(new Driver());
        $data = $request->validated();
        unset(
            $data['images'],
            $data['delete_images']
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

        return response()->json([
            'status' => 200,
            'message' => 'Product updated successfully',
            'data' => $product
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        foreach ($product->images as $img) {
            Storage::disk('public')->delete([
                'products/85x84/' . $img->image,
                'products/329x380/' . $img->image,
                'products/full/' . $img->image,
            ]);
            $img->delete();
        }

        $product->destroy($id);

        return response()->json([
            'status' => 200,
            'message' => 'Product deleted successfully'
        ], 200);
    }
}
