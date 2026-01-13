@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.title', [
        'title' => 'Create Blog',
    ])
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                    <form class="form-horizontal" method="POST" action="/admin/blog" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label id="title">Title</label>
                            <input type="text" class="form-control" placeholder="Title..." name="title">
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="form-group">
                            <label id="description">Description</label>
                            <input type="text" class="form-control" placeholder="Description..." name="description">
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" style="margin-right: 10px;">Create</button>
                                <a href="{{ route('admin.blogs') }}" class="btn btn-danger float-right">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
