<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateUserByAdminRequest;
use App\Http\Requests\Api\Users\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => User::with('country')->where('level', '=', '0', false)
                ->orderBy('id')
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
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['level'] = 0;
        $data['email_verified_at'] = now();
        $data['remember_token'] = Str::random(10);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request
                ->file('avatar')
                ->store('avatars/members', 'public');
        }

        $user = User::create($data);

        return response()->json([
            'status' => 200,
            'message' => 'Created user successfully',
            'data' => $user
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'status' => 200,
            'data' => $user->load('country')
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
    public function update(UpdateUserByAdminRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request
                ->file('avatar')
                ->store('avatars/members', 'public');
        }

        $user->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Update profile user successfully',
            'data' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        if (! $user->destroy($user->id)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete user'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted user sucessfully'
        ], 200);
    }
}
