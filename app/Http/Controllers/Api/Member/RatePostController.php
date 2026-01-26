<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatePostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => Rate::all()
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
    public function store(Request $request)
    {
        $request->validate([
            'blog_id' => ['required', 'exists:blogs,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        $exists = Rate::where('user_id', Auth::id())
            ->where('blog_id', $request->blog_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'You rated this post',
            ], 409);
        }

        Rate::create([
            'user_id' => Auth::id(),
            'blog_id' => $request->blog_id,
            'rating' => $request->rating,
        ]);

        $blog = Blog::withAvg('rates', 'rating')
            ->withCount('rates')
            ->find($request->blog_id, 'id');

        return response()->json([
            'status' => 200,
            'message' => 'Rating post successfully',
            'avg' => $blog->rates_avg_rating,
            'count' => $blog->rates_count
        ], 200);
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
