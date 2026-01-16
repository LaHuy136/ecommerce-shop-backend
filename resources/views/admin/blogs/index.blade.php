@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.title', [
        'title' => 'Blog',
    ])

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Image</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr>
                            <th scope="row">{{ $blog->id }}</th>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->image }}</td>
                            <td>{{ $blog->description }}</td>
                            <td class="flex flex-col items-center">
                                <button class="btn btn-primary"><a style="color: white"
                                        href="/admin/blogs/{{ $blog->id }}/edit">Edit</a></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-5 align-self-center" style="margin-left:20px">
            <a href="/admin/blogs/create" class="btn btn-success">Create Blog</a>
        </div>
    </div>
@endsection
