@extends('frontend.layouts.layout')

@section('content')
    {{-- @foreach ($categories as $category)
        {{ dd(old('category_id', $product->category_id) == $category->id ? 'true' : 'false') }}
    @endforeach --}}
    {{-- {{ dd($product->images) }} --}}

    <section>
        <div class="container">
            <div class="row">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Notification!</h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Notification!</h4>
                        {{ session('success') }}
                    </div>
                @endif
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Account & Product</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
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
                    <div class="blog-post-area">
                        <h2 class="title text-center">Edit Product</h2>

                        <div class="signup-form">
                            <form action="/product/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="name" class="col-md-12">Product Name</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-line" name="name"
                                            value="{{ $product->name }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="price" class="col-md-12">Price</label>
                                    <div class="col-md-12">
                                        <input type="price" class="form-control form-control-line" name="price"
                                            value="{{ $product->price }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="country_id" class="col-sm-12">Please choose category</label>
                                    <div class="col-sm-12">
                                        <select class="form-control form-control-line" name="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="country_id" class="col-sm-12">Please choose brand</label>
                                    <div class="col-sm-12">
                                        <select class="form-control form-control-line" name="brand_id">
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="condition" class="col-md-12">Condition</label>
                                    <div class="col-md-12">
                                        <select class="form-control form-control-line" name="condition" id="condition">
                                            <option value="new"
                                                {{ old('condition', $product->condition) === 'new' ? 'selected' : '' }}>
                                                New
                                            </option>
                                            <option value="sale"
                                                {{ old('condition', $product->condition) === 'sale' ? 'selected' : '' }}>
                                                Sale
                                            </option>
                                        </select>

                                        <div id="sale-percent" style="display:none;">
                                            <label>Sale %</label>
                                            <input type="number" name="sale_percent" min="1" max="100"
                                                value="{{ old('sale_percent', $product->sale_percent) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="company" class="col-md-12">Company</label>
                                    <div class="col-md-12">
                                        <input type="company" class="form-control form-control-line" name="company"
                                            value="{{ $product->company }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Product Images</label>
                                    <div class="col-md-12">
                                        <input type="file" name="images[]" class="form-control" multiple
                                            accept="image/*">
                                    </div>
                                </div>

                                <div class="row">
                                    @foreach ($product->images as $img)
                                        <div class="col-sm-4 text-center mb-3">
                                            <img src="{{ asset('storage/products/85x84/' . $img->image) }}"
                                                alt="Product Image" class="img-thumbnail">

                                            <div class="form-check mt-2">
                                                <input type="checkbox" name="delete_images[]"
                                                    value="{{ $img->id }}" id="delete_image_{{ $img->id }}">
                                                <label for="delete_image_{{ $img->id }}">Delete this photo</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Description</label>
                                    <div class="col-md-12">
                                        <textarea rows="5" name="description" class="form-control form-control-line">
                                            {{ $product->description }}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-default" style="margin: 20px 0px">Confirm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function toggleSalePercent() {
            const conditionSelect = document.getElementById('condition').value;
            const salePercentDiv = document.getElementById('sale-percent');

            if (conditionSelect === 'sale') {
                salePercentDiv.style.display = 'block';
            } else {
                salePercentDiv.style.display = 'none';
            }

        }

        document.addEventListener('DOMContentLoaded', toggleSalePercent);
        document.getElementById('condition').addEventListener('change', toggleSalePercent)
    </script>
@endsection
