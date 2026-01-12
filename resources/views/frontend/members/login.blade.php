@extends('frontend.layouts.layout')


@section('content')
    <section style="margin: 20px 0px">
        <div class="container">
            <div class="login-form">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('member.dashboard') }}">Home</a></li>
                        <li class="active">Login</li>
                    </ol>
                </div>
                <form action="/login" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" placeholder="johnathan@example.com" class="form-control form-control-line"
                            name="email" id="email">
                    </div>

                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-sm-9">
                                <label for="password">Password</label>
                            </div>
                            <div class="col-sm-3">
                                <a href="{{ url('/forgot-password') }}" class="pull-right"
                                    style="font-style: italic; font-weight: bold;">Forgot password ?</a>
                            </div>
                        </div>
                        <input type="password" name="password" class="form-control form-control-line">
                    </div>

                    <div class="form-group">
                        <span><b>You don't have account ? </b></span>
                        <a href="{{ url('/register') }}" style="font-style: italic; font-weight: bold;">Register</a>
                    </div>

                    <span style="font-weight: bold; line-height: 28px;">
                        <input type="checkbox" class="checkbox">
                        Keep me signed in
                    </span>

                    <button type="submit" class="btn btn-default">Login</button>
                </form>
            </div>
        </div>
    </section>
@endsection
