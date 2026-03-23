@extends('frontend.layouts.layout')

@section('content')
    <section id="advertisement">
        <div class="container">
            <img src="{{ asset('frontend/images/shop/advertisement.jpg') }}" alt="" />
        </div>
    </section>
    @include('frontend.layouts.left-sidebar', [
        'categories' => $categories,
        'brands' => $brands,
    ])

    <div class="col-sm-9 padding-right">
        <!--features_items-->
        <div class="features_items">
            <h2 class="title text-center">Features Items</h2>
            <div class="card" style="margin-left: 30px; margin-bottom: 10px">
                <div class="card-body">
                    <form action="{{ route('products.search.advanced') }}" method="GET" id="search-form">
                        {{-- @csrf --}}
                        <div class="row g-3 align-items-end">
                            <div class="col-sm-3">
                                <label class="form-label" for="name">Product name</label>
                                <input type="text" name="name" class="form-control" placeholder="Search product..."
                                    value="{{ request('name') }}">
                            </div>

                            <div class="col-sm-2">
                                <label class="form-label" for="price">Price</label>
                                <select name="price" class="form-select">
                                    <option value="">All</option>
                                    <option value="0-60" {{ request('price') == '0-60' ? 'selected' : '' }}>< 60
                                    </option>
                                    <option value="60-200" {{ request('price') == '60-200' ? 'selected' : '' }}>60 - 200
                                    </option>
                                    <option value="200-999999" {{ request('price') == '200-999999' ? 'selected' : '' }}>> 200
                                    </option>
                                </select>
                            </div>

                            <div class="col-sm-2">
                                <label class="form-label" for="category">Category</label>
                                <select name="category" class="form-select">
                                    <option value="">All</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->name }}"
                                            {{ request('category') == $category->name ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-2">
                                <label class="form-label" for="brand">Brand</label>
                                <select name="brand" class="form-select">
                                    <option value="">All</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->name }}"
                                            {{ request('brand') == $brand->name ? 'selected' : '' }}>
                                            {{ $brand->name }}</option>
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

            <div id="product-list">
                @include('frontend.partials.product_list', [
                    'products' => $products,
                ])
            </div>
        </div>
        <div>
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <script src="{{ asset('frontend/js/handle-search-by-price.js') }}"></script>
@endsection
