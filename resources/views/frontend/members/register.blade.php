@extends('frontend.layouts.layout')

@section('content')
    <section style="margin: 20px 0px">
        <div class="container">
            <div class="signup-form">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('member.dashboard') }}">Home</a></li>
                        <li class="active">Register</li>
                    </ol>
                </div>

                <form action="/register" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div pss="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" placeholder="Johnathan Doe" name="name"
                            class="form-control form-control-line">

                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line"
                            name="email" id="email">

                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control form-control-line">

                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmation Password</label>

                        <input type="password" name="password_confirmation" class="form-control form-control-line">

                    </div>

                    <div class="form-group">
                        <label for="phone">Phone No</label>
                        <input type="text" name="phone" placeholder="+84 363203112"
                            class="form-control form-control-line">

                    </div>

                    <div class="form-group">
                        <label>Avatar</label>
                        <input type="file" name="avatar" class="form-control" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="country_id" class="col-sm-12">Select Country</label>
                        <select class="form-control form-control-line" name="country_id">
                            @if (is_iterable($countries))
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div style="margin-bottom: 30px">
                        <span>You have account ? </span> <a href="{{ url('/login') }}">Login</a>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-default" type="submit">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
