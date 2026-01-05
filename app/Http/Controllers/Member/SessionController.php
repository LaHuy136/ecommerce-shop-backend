<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\LoginMemberRequest;
use App\Http\Requests\Member\UpdateMemberRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SessionController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function create()
    {
        return view('frontend.members.login');
    }

    public function login(LoginMemberRequest $request)
    {
        $data = $request->validated();

        $remember = $request->filled('remember_me');

        if (!Auth::attempt($data, $remember)) {
            return back()
                ->withErrors('Email or password is not correct');
        }

        $user = Auth::user();

        if ($user->level == 1) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('member.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function edit()
    {
        return view(
            'frontend.members.account',
            [
                'user' => Auth::user()->load('country'),
                'countries' => Country::get()
            ]
        );
    }

    public function update(UpdateMemberRequest $request)
    {
        $user = Auth::user();
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
                ->store('avatars', 'public');
        }

        $user->update($data);

        return back()->with(
            'success',
            'Update profile successfully'
        );
    }
}
