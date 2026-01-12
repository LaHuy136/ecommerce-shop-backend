<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            {{-- <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Sportswear
                        </a>
                    </h4>
                </div>
                <div id="sportswear" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li><a href="">Nike </a></li>
                            <li><a href="">Under Armour </a></li>
                            <li><a href="">Adidas </a></li>
                            <li><a href="">Puma</a></li>
                            <li><a href="">ASICS </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Mens
                        </a>
                    </h4>
                </div>
                <div id="mens" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li><a href="">Fendi</a></li>
                            <li><a href="">Guess</a></li>
                            <li><a href="">Valentino</a></li>
                            <li><a href="">Dior</a></li>
                            <li><a href="">Versace</a></li>
                            <li><a href="">Armani</a></li>
                            <li><a href="">Prada</a></li>
                            <li><a href="">Dolce and Gabbana</a></li>
                            <li><a href="">Chanel</a></li>
                            <li><a href="">Gucci</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Womens
                        </a>
                    </h4>
                </div>
                <div id="womens" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li><a href="">Fendi</a></li>
                            <li><a href="">Guess</a></li>
                            <li><a href="">Valentino</a></li>
                            <li><a href="">Dior</a></li>
                            <li><a href="">Versace</a></li>
                        </ul>
                    </div>
                </div>
            </div> --}}
            @foreach ($categories as $category)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="#">{{ $category->name }}</a></h4>
                    </div>
                </div>
            @endforeach
            {{-- <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#">Fashion</a></h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#">Households</a></h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#">Interiors</a></h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#">Clothing</a></h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#">Bags</a></h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#">Shoes</a></h4>
                </div>
            </div> --}}
        </div><!--/category-products-->

        <div class="brands_products"><!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach ($brands as $brand)
                        @if ($brand->products_count > 0)
                            <li>
                                <a href="">
                                    <span class="pull-right">({{ $brand->products_count }})</span>
                                    {{ $brand->name }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                    </li>
                </ul>
            </div>
        </div><!--/brands_products-->

        <div class="price-range"><!--price-range-->
            <h2>Price Range</h2>
            <div class="well">
                <input type="text" value="" data-slider-min="0" data-slider-max="1000" data-slider-step="5"
                    data-slider-value="[450,500]" id="sliderPrice"><br />
                <span id="minPrice"><b>$ 0</b></span>
                <span class="pull-right" id="maxPrice"><b>$ 1000</b></span>
            </div>
        </div><!--/price-range-->

        <!--shipping-->
        <div class="shipping text-center">
            <img src="{{ asset('frontend/images/home/shipping.jpg') }}" alt="" />
        </div>
        <!--/shipping-->
    </div>
</div>
