@extends('frontend.layouts.layout')

@section('content')
    <section id="advertisement">
        <div class="container">
            <img src="{{ asset('frontend/images/shop/advertisement.jpg') }}" alt="" />
        </div>
    </section>
    @include('frontend.layouts.left-sidebar')

    <div class="col-sm-9 padding-right">
        <!--features_items-->
        <div class="features_items">
            <h2 class="title text-center">Features Items</h2>
            @foreach ($products as $product)
                <div class="col-sm-4">
                    <div class="product-image-wrapper" data-id="{{ $product->id }}">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                {{-- Image --}}
                                <img src="{{ asset('storage/products/full/' . $product->images->first()->image) }}"
                                    style="height: 320px" alt="Product Image..." />

                                {{-- Price --}}
                                <h2>$ {{ $product->price }}</h2>

                                {{-- Name --}}
                                <p>{{ $product->name }}</p>

                                <a href="#" class="btn btn-default add-to-cart">
                                    <i class="fa fa-shopping-cart"></i> Add to cart</a>
                            </div>

                            <a href="/product/{{ $product->id }}">
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>$ {{ $product->price }}</h2>
                                        <p>{{ $product->name }}</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a>
                                </li>
                                <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach

            <ul class="pagination">
                {{-- <li class="active"><a href="">1</a></li>
                                    <li><a href="">2</a></li>
                                    <li><a href="">3</a></li>
                                    <li><a href="">&raquo;</a></li> --}}
                {{ $products->links('pagination::bootstrap-4') }}
            </ul>
        </div>
    </div>
@endsection
