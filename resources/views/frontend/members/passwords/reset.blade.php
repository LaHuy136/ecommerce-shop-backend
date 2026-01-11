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
                <form method="POST" action="{{ route('password.forgot') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                            class="form-control form-control-line" name="email" id="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Reset Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
