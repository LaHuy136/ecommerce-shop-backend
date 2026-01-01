<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\MemberLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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


    public function Login(MemberLoginRequest $request)
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

    public function Logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
