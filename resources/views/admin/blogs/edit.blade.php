@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.title', [
        'title' => 'Edit Blog',
    ])

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                    <form class="form-horizontal" action="/admin/blog/{{ $blog->id }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $blog->title }}">
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" class="form-control" value="{{ $blog->description }}">
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="form-control">
                                {{ $blog->content }}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" style="margin-right: 10px;">Update Blog</button>
                                <button class="btn btn-danger" form="delete-form">Delete Blog</button>
                                <a href="/admin/blog" class="btn btn-danger float-right">Cancel</a>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="/admin/blog/{{ $blog->id }}" id="delete-form" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
