@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.title', [
        'title' => 'Show User',
    ])

    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30">
                            <img src="{{ $user->avatar ? Storage::url($user->avatar) : asset('admin/assets/images/users/5.jpg') }}"
                                class="rounded-circle" width="150" />
                            <h4 class="card-title m-t-10">{{ $user->name }}</h4>
                        </center>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <small class="text-muted">Email address </small>
                        <h6>{{ $user->email }}</h6>

                        <small class="text-muted p-t-30 db">Phone</small>
                        <h6>{{ $user->phone }}</h6>

                        <div class="map-box">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508"
                                width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                        <small class="text-muted p-t-30 db">Social Profile</small>
                        <br />
                        <button class="btn btn-circle btn-secondary"><i class="mdi mdi-facebook"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="mdi mdi-twitter"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="mdi mdi-youtube-play"></i></button>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal form-material" action="" enctype="multipart/form-data">
                            <div pss="form-group">
                                <label for="name" class="col-md-12">Full Name</label>
                                <div class="col-md-12">
                                    <input type="text" name="name" id="name" value="{{ $user->name }}"
                                        class="form-control form-control-line" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" name="email" id="email" value="{{ $user->email }}"
                                        class="form-control form-control-line" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-md-12">Phone No</label>
                                <div class="col-md-12">
                                    <input type="text" name="phone" id="phone" value="{{ $user->phone }}"
                                        class="form-control form-control-line" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="country_id" class="col-sm-12">Country</label>
                                <div class="col-md-12">
                                    <input name="country" class="form-control form-control-line" type="text"
                                        value="{{ $user->country->name }}" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>
@endsection
