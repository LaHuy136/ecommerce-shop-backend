<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        Rate::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'blog_id' => $request->blog_id,
            ],
            [
                'rating' => $request->rating,
            ]
        );

        // $avg = Rate::where('blog_id', $request->blog_id)
        // ->avg('rating');
        // $count = Rate::where('blog_id', $request->blog_id)
        // ->count();

        return response()->json([
            'message' => 'Rating post successfully',
            // 'avg'     => round($avg, 1),
            // 'count'   => $count
        ]);
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
