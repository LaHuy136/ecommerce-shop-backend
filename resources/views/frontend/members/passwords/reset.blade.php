@extends('frontend.layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ route('member.dashboard') }}">Home</a></li>
                    <li class="active">Reset Password</li>
                </ol>
            </div>

            <div class="card-body">
                <h4>
                    Please confirm your new password before continuing.
                </h4>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" required autocomplete="new-password" autofocus
                            class="form-control form-control-line" name="password" id="password">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" required autocomplete="new-password" autofocus
                            class="form-control form-control-line" name="password_confirmation" id="password_confirmation">
                    </div>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Confirm Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
