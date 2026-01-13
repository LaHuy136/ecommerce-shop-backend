@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.title', [
        'title' => 'Products',
    ])
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                    <form action="/admin/product/search" method="GET">
                        <div class="form-group">
                            <label for="search"> <i>Search Product By Member Name</i></label>
                            <input type="text" name="memberName" class="form-control" placeholder="Search...">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Condition</th>
                            <th scope="col">Company</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>
                                    <a href="/admin/product/{{ $product->id }}">
                                        {{ $product->name }}
                                    </a>
                                </td>
                                <td>$ {{ $product->price }}</td>
                                <td>{{ ucfirst($product->status) }}</td>
                                <td>{{ ucfirst($product->condition) }}</td>
                                <td>{{ $product->company }}</td>

                                <td class="flex flex-col items-center">
                                    <button class="btn btn-primary"><a style="color: white"
                                            href="/admin/product/{{ $product->id }}/edit">Edit</a></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="padding-left: 15px">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <div class="row">
            <div class="col-5 align-self-center" style="margin-left:20px">
                <a href="/admin/product/create" class="btn btn-success">Create Product</a>
            </div>
        </div>
    @endsection
