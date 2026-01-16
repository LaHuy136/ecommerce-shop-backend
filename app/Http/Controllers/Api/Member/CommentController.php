<?php

namespace App\Http\Controllers\Api\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Member\StoreCommentRequest;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Blog $blog)
    {
        $comments = $blog->comments()
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'parent_id' => $comment->parent_id,
                    'user_name' => $comment->user->name,
                    'user_avatar' => $comment->user->avatar
                        ? asset($comment->user->avatar)
                        : null,
                    'content' => $comment->content,
                    'created_at_time' => $comment->created_at->format('h:i A'),
                    'created_at_date' => $comment->created_at->format('M d, Y'),
                ];
            });

        return response()->json([
            'status' => 200,
            'data' => $comments
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
    public function store(StoreCommentRequest $request)
    {
        Comment::create(
            [
                ...$request->validated(),
                'user_id' => Auth::user()->id,
            ]
        );

        return response()->json([
            'status' => 200,
            'message' => 'Comment posted successfully'
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
