@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.title', [
        'title' => 'Edit Product',
    ])

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                    <form class="form-horizontal" method="POST" action="/admin/product/{{ $product->id }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name" class="col-md-12">Product Name</label>

                            <input type="text" class="form-control form-control-line" name="name"
                                value="{{ $product->name }}">

                        </div>

                        <div class="form-group">
                            <label for="price" class="col-md-12">Price ($)</label>

                            <input type="number" class="form-control form-control-line" name="price"
                                value="{{ $product->price }}">

                        </div>

                        <div class="form-group">
                            <label for="country_id" class="col-sm-12">Please choose category</label>

                            <select class="form-control form-control-line" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="brand_id" class="col-sm-12">Please choose brand</label>

                            <select class="form-control form-control-line" name="brand_id">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="condition" class="col-md-12">Condition</label>

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
                        </div>

                        <div id="sale-percent" class="form-group" style="display:none;">
                            <label for="sale_percent" class="col-md-12">Sale %</label>
                            <input type="number" class="form-control form-control-line" name="sale_percent" min="1"
                                max="100" value="{{ old('sale_percent', $product->sale_percent) }}">
                        </div>

                        <div class="form-group">
                            <label for="company" class="col-md-12">Company</label>

                            <input type="company" class="form-control form-control-line" name="company"
                                value="{{ $product->company }}">

                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Product Images</label>

                            <input type="file" name="images[]" class="form-control" multiple accept="image/*">

                        </div>

                        <div class="row">
                            @foreach ($product->images as $img)
                                <div class="col-sm-4 text-center mb-3">
                                    <img src="{{ asset('storage/products/85x84/' . $img->image) }}" alt="Product Image"
                                        class="img-thumbnail">

                                    <div class="form-check mt-2">
                                        <input type="checkbox" name="delete_images[]" value="{{ $img->id }}"
                                            id="delete_image_{{ $img->id }}">
                                        <label for="delete_image_{{ $img->id }}">Delete this photo</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea rows="5" name="description" class="form-control form-control-line">{{ $product->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" style="margin-right: 10px;">Update Product</button>
                                <button class="btn btn-danger" form="delete-form">Delete Product</button>
                                <a href="{{ route('admin.products') }}" class="btn btn-danger float-right">Cancel</a>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="/admin/product/{{ $product->id }}" id="delete-form" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
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
