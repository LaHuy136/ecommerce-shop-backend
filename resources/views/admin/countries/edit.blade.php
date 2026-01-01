@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.title', ['title' => 'Edit Country'])
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                    <form class="form-horizontal m-t-30" method="POST" action="/admin/country/{{ $country->id }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label id="name">Country</label>
                            <input type="text" class="form-control" value="{{ $country->name }}" name="name">
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" style="margin-right: 10px;">Update Country</button>
                                <button class="btn btn-danger" form="delete-form">Delete Country</button>
                                <a href="/admin/country" class="btn btn-danger float-right">Cancel</a>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="/admin/country/{{ $country->id }}" id="delete-form" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
