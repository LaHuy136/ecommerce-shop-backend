@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.title', ['title' => 'Create Country'])
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                    <form class="form-horizontal m-t-30" method="POST" action="/admin/country">
                        @csrf
                        <div class="form-group">
                            <label id="name">Country</label>
                            <input type="text" class="form-control" placeholder="Vietnam" name="name">
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success">Create Country</button>
                                <a href="/admin/country" class="btn btn-danger float-right">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
