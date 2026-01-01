<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\MemberRegisterRequest;
use App\Http\Requests\Member\MemberLoginRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterMemberController extends Controller
{
    public function create()
    {
        // dd(Country::get());
        return view('frontend.members.register', [
            'countries' => Country::get()
        ]);
    }

    public function register(MemberRegisterRequest $request)
    {
        $data = $request->validated();
        $data['level'] = 0;

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request
                ->file('avatar')
                ->store('members', 'public');
        }

        User::create($data);

        return redirect('/login');
    }
}
