<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\UpdateMemberRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SessionController extends Controller
{
    public function register(RegisterRequest $request)
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

        User::create($data);

        return response()->json([
            'status' => 'sucess',
            'message' => 'Register successfully',
        ], 200);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $remember = $request->filled('remember_me');

        if (!Auth::attempt($data, $remember)) {
            return response()->json(
                [
                    'status' => 'error',
                    'errors' => [
                        'error' => 'Invalid email or password'
                    ]
                ],
                404
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'token' => Auth::user()->createToken('authToken')->plainTextToken,
                'user' => Auth::user()
            ],
            200
        );
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? response()->json([
                'status' => 'sucess',
                'message' => __($status)
            ], 200)
            : response()->json([
                'status' => 'error',
                'message' => __($status)
            ], 404);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),
            function (User $user, string $password) {
                $user->forceFill([
                    'email_verified_at' => now(),
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return $status === Password::PasswordReset
            ? response()->json([
                'status' => 'sucess',
                'message' => __($status)
            ], 200)
            : response()->json([
                'status' => 'error',
                'message' => __($status)
            ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, string $id)
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
            'message' => 'Update profile successfully',
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
