@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.title', [
        'title' => 'Create Category',
    ])
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                    <form class="form-horizontal m-t-30" method="POST" action="/admin/categories">
                        @csrf
                        <div class="form-group">
                            <label id="name">Category</label>
                            <input type="text" class="form-control" placeholder="Category Name" name="name">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success">Create</button>
                            <a href="{{ route('admin.categories') }}" class="btn btn-danger float-right">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
