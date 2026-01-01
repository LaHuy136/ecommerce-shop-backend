@extends('frontend.layouts.layout')

@section('content')
    <section style="margin: 20px 20px">
        <div class="container">
            <div>
                <div class="login-form">
                    <h2>Login to your account</h2>

                    <form action="/login" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" placeholder="johnathan@example.com" class="form-control form-control-line"
                                name="email" id="email">

                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control form-control-line">
                        </div>

                        <div class="row">
                            <div class="col-sm-10">
                                <span>You don't have account ? </span> <a href="{{ url('/register') }}">Register</a>
                            </div>

                            <span class="col-sm-2">
                                <input type="checkbox" class="checkbox">
                                Keep me signed in
                            </span>
                        </div>

                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
