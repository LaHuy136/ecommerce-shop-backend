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
            <div class="card" style="margin-left: 30px; margin-bottom: 10px">
                <div class="card-body">
                    <form action="/products/searchAdvanced" method="POST">
                        @csrf
                        <div class="row g-3 align-items-end">
                            <div class="col-sm-3">
                                <label class="form-label" for="name">Product name</label>
                                <input type="text" name="name" class="form-control" placeholder="Search product...">
                            </div>

                            <div class="col-sm-2">
                                <label class="form-label" for="price">Price</label>
                                <select name="price" class="form-select">
                                    <option value="">All</option>
                                    <option value="0-60">&lt; 60</option>
                                    <option value="60-200">60 - 200</option>
                                </select>
                            </div>

                            <div class="col-sm-2">
                                <label class="form-label" for="category">Category</label>
                                <select name="category" class="form-select">
                                    <option value="">All</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-2">
                                <label class="form-label" for="brand">Brand</label>
                                <select name="brand" class="form-select">
                                    <option value="">All</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3 d-grid">
                                <button class="btn btn-primary" style="margin-top: 22px">
                                    <i class="fa fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


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
