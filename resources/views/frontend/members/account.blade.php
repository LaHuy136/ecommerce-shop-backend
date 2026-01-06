@extends('frontend.layouts.layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Notification!</h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Notification!</h4>
                        {{ session('success') }}
                    </div>
                @endif
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Account & Product</h2>

                        <div class="panel-group category-products" id="accordian">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{ route('members.account') }}">Account</a></h4>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{ route('products.index') }}">My product</a></h4>
                                </div>
                            </div>
                        </div>

                        <img src="{{ $user->avatar ? Storage::url($user->avatar) : asset('admin/assets/images/users/5.jpg') }}"
                            class="rounded-circle" width="150" height="auto" />
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="blog-post-area">
                        <h2 class="title text-center">Update user</h2>

                        <div class="signup-form">
                            <form action="/account/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="name" class="col-md-12">Full Name</label>
                                    <div class="col-md-12">
                                        <input type="text" name="name" value="{{ $user->name }}"
                                            class="form-control form-control-line">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" value="{{ $user->email }}"
                                            class="form-control form-control-line" name="email" id="email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-md-12">Password</label>
                                    <div class="col-md-12">
                                        <input type="password" name="password" value="{{ $user->password }}"
                                            class="form-control form-control-line">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation" class="col-md-12">Confirmation Password</label>
                                    <div class="col-md-12">
                                        <input type="password" name="password_confirmation" value="{{ $user->password }}"
                                            class="form-control form-control-line">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="col-md-12">Phone No</label>
                                    <div class="col-md-12">
                                        <input type="text" name="phone" value="{{ $user->phone }}"
                                            class="form-control form-control-line">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Avatar</label>
                                    <div class="col-md-12">
                                        <input type="file" name="avatar" class="form-control" accept="image/*">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="country_id" class="col-sm-12">Select Country</label>
                                    <div class="col-sm-12">
                                        <select class="form-control form-control-line" name="country_id">
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ old('country_id', $user->country_id) == $country->id ? 'selected' : '' }}>
                                                    {{ $country->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-default" style="margin: 20px 0px">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
