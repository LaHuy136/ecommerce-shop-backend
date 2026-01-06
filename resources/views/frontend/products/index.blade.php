@extends('frontend.layouts.layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
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
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="table-responsive cart_info">
                        @if ($products->isEmpty())
                            <h3 class="text-center">No found products</h3>
                        @else
                            <h2 class="title text-center">Update user</h2>
                            <table class="table table-condensed">
                                <thead>
                                    <tr class="cart_menu">
                                        <td class="id">ID</td>
                                        <td class="image">Image</td>
                                        <td class="description">Name</td>
                                        <td class="price">Price</td>
                                        <td class="total">Action</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>

                                            <td class="cart_product">
                                                <a href="/product/{{ $product->id }}">
                                                    <img src="{{ asset('storage/products/85x84/' . $product->images->first()->image) }}"
                                                        alt="Image Product...">
                                                </a>
                                            </td>

                                            <td class="cart_description">
                                                <h4>
                                                    <a href="/product/{{ $product->id }}">{{ $product->name }}</a>
                                                </h4>
                                            </td>

                                            <td class="cart_price">
                                                <p>$ {{ $product->price }}</p>
                                            </td>

                                            {{-- Edit --}}
                                            <td>
                                                <button class="btn btn-default">
                                                    <a href="/product/{{ $product->id }}/edit">
                                                        <i style="font-size:18px" class="fa">&#xf044;</i>
                                                    </a>
                                                </button>
                                            </td>

                                            {{-- Delete --}}
                                            <td>
                                                <button form="delete-form" class="btn btn-default">
                                                    <i style="font-size:18px" class="fa">&#xf00d;</i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <form id="delete-form" method="POST" action="/product/{{ $product->id }}"
                                        class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </tbody>
                            </table>
                            <div class="pagination-area">
                                {{ $products->links('pagination::bootstrap-4') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group" style="float: right">
                        <a class="btn btn-default" href="/product/create">Add new
                            product</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
