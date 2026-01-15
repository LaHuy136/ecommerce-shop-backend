<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Blogs\StoreBlogRequest;
use App\Http\Requests\Api\Blogs\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 200,
            'message' => Blog::latest('created_at')
                ->paginate(5)
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
    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;

        if ($request->hasFile('image')) {
            $data['image'] = $request
                ->file('image')
                ->store('blogs', 'public');
        }

        $blog = Blog::create($data);

        return response()->json([
            'status' => 200,
            'message' => 'Created blog successfully',
            'data' => $blog
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $blog
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
    public function update(UpdateBlogRequest $request, string $id)
    {
        $blog = Blog::findOrFail($id);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $data['image'] = $request
                ->file('image')
                ->store('blogs', 'public');
        }

        $blog->update($data);

        return response()->json([
            'status' => 200,
            'message' => 'Updated country successfully',
            'data' => $blog
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->destroy($blog->id);

        return response()->json([
            'status' => 200,
            'message' => 'Deleted blog successfully'
        ], 200);
    }
}
