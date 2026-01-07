@extends('frontend.layouts.layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Account ́& Product</h2>
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
                        <h2 class="title text-center">Create Product</h2>

                        <div class="signup-form">
                            <form action="/product" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="col-md-12">Product Name</label>
                                    <div class="col-md-12">
                                        <input type="text" name="name" class="form-control form-control-line">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="price" class="col-md-12">Price</label>
                                    <div class="col-md-12">
                                        <input type="price" class="form-control form-control-line" name="price">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="country_id" class="col-sm-12">Please choose category</label>
                                    <div class="col-sm-12">
                                        <select class="form-control form-control-line" name="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
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
                                                <option value="{{ $brand->id }}">
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="col-md-12">Condition</label>
                                    <div class="col-md-12">
                                        <select class="form-control form-control-line" name="condition" id="condition">
                                            <option value="new">New</option>
                                            <option value="sale">Sale</option>
                                        </select>

                                        <div id="sale-percent" style="display:none;">
                                            <label>Sale %</label>
                                            <input type="number" name="sale_percent" min="1" max="100">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="company" class="col-md-12">Company</label>
                                    <div class="col-md-12">
                                        <input type="company" class="form-control form-control-line" name="company">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Product Images</label>
                                    <div class="col-md-12">
                                        <input type="file" name="images[]" class="form-control" multiple
                                            accept="image/*">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Description</label>
                                    <div class="col-md-12">
                                        <textarea rows="5" name="description" class="form-control form-control-line"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-default" style="margin: 20px 0px">Create</button>
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
        document.getElementById('condition').addEventListener('change', function() {
            const salePercentDiv = document.getElementById('sale-percent');
            if (this.value == 'sale') {
                salePercentDiv.style.display = 'block';
            } else {
                salePercentDiv.style.display = 'none';
            }
        })
    </script>
@endsection
