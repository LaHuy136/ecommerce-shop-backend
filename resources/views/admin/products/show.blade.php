@extends('admin.layouts.layout')

@section('content')
    @include('admin.layouts.title', [
        'title' => 'Show Product',
    ])

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="name" class="col-md-12">Product Name</label>

                            <input type="text" class="form-control form-control-line" name="name"
                                value="{{ $product->name }}" readonly>

                        </div>

                        <div class="form-group">
                            <label for="price" class="col-md-12">Price</label>

                            <input type="number" class="form-control form-control-line" name="price"
                                value="{{ $product->price }}" readonly>

                        </div>

                        <div class="form-group">
                            <label for="country" class="col-sm-12">Category</label>

                            <input name="country" class="form-control form-control-line" type="text"
                                value="{{ $product->category->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="brand" class="col-sm-12">Brand</label>

                            <input name="brand" class="form-control form-control-line" type="text"
                                value="{{ $product->brand->name }}" readonly>

                        </div>

                        <div class="form-group">
                            <label for="condition" class="col-md-12">Condition</label>

                            <select class="form-control form-control-line" name="condition" id="condition" disabled>
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
                                max="100" value="{{ old('sale_percent', $product->sale_percent) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="company" class="col-md-12">Company</label>

                            <input type="company" class="form-control form-control-line" name="company"
                                value="{{ $product->company }}" readonly>

                        </div>

                        <div class="row">
                            @foreach ($product->images as $img)
                                <div class="col-sm-4 text-center mb-3">
                                    <img src="{{ asset('storage/products/329x380/' . $img->image) }}" alt="Product Image"
                                        class="img-thumbnail">
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea rows="5" name="description" class="form-control form-control-line" readonly>{{ $product->description }}</textarea>
                        </div>
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
