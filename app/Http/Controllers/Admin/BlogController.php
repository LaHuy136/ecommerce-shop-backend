<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Http\Requests\Admin\Blogs\StoreBlogRequest;
use App\Http\Requests\Admin\Blogs\UpdateBlogRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.blogs.index', [
            'blogs' => Blog::get()
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::user()->getAttribute('id');

        if ($request->hasFile('image')) {
            $data['image'] = $request
                ->file('image')
                ->store('blogs', 'public');
        }

        Blog::create($data);

        return redirect()
            ->route('admin.blogs')->with(
                'success',
                'Created blog successfully'
            );;
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact(
            'blog'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact(
            'blog'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
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

        return redirect()
            ->route('admin.blogs')
            ->with(
                'success',
                'Updated blog successfully'
            );;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()
            ->route('admin.blogs')
            ->with(
                'success',
                'Deleted blog successfully'
            );;
    }
}
