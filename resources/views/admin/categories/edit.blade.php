@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.title', [
        'title' => 'Edit Category',
    ])
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                    <form class="form-horizontal m-t-30" method="POST" action="/admin/categories/{{ $category->id }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label id="name">Category</label>
                            <input type="text" class="form-control" value="{{ $category->name }}" name="name">
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" style="margin-right: 10px;">Update Category</button>
                                <button class="btn btn-danger" form="delete-form">Delete Category</button>
                                <a href="{{ route('admin.categories') }}" class="btn btn-danger float-right">Cancel</a>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="/admin/categories/{{ $category->id }}" id="delete-form" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
