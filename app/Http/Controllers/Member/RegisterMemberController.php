<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\RegisterMemberRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterMemberController extends Controller
{
    public function create()
    {
        return view('frontend.members.register', [
            'countries' => Country::get()
        ]);
    }

    public function register(RegisterMemberRequest $request)
    {
        $data = $request->validated();
        $data['level'] = 0;

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request
                ->file('avatar')
                ->store('avatars/members', 'public');
        }

        $user = User::create($data);

        event(new Registered($user));

        Auth::login($user);

        return redirect()
            ->route('member.dashboard');
    }
}
