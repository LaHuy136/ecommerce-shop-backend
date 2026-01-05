@extends('frontend.layouts.layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            <div class="panel panel-default">
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
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#">Kids</a></h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
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
                            </div>
                        </div>
                        <!--/category-products-->

                        <!--brands_products-->
                        <div class="brands_products">
                            <h2>Brands</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href=""> <span class="pull-right">(50)</span>Acne</a></li>
                                    <li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                                    <li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
                                    <li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
                                    <li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
                                    <li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
                                    <li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--/brands_products-->

                        <!--price-range-->
                        <div class="price-range">
                            <h2>Price Range</h2>
                            <div class="well">
                                <input type="text" class="span2" value="" data-slider-min="0"
                                    data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]"
                                    id="sl2"><br />
                                <b>$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div>
                        <!--/price-range-->

                        <!--shipping-->
                        <div class="shipping text-center">
                            <img src="{{ asset('frontend/images/home/shipping.jpg') }}" alt="" />
                        </div>
                        <!--/shipping-->

                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="blog-post-area">
                        <h2 class="title text-center">Latest From our Blog</h2>
                        <div class="single-blog-post">
                            {{-- Title --}}
                            <h3>{{ $blog->title }}</h3>

                            {{-- Descripton --}}
                            <h5>{{ $blog->description }}</h5>

                            {{-- Author & Post Date --}}
                            <div class="post-meta">
                                <ul>
                                    <li><i class="fa fa-user"></i> {{ $blog->user->name }}</li>
                                    <li><i class="fa fa-clock-o"></i>
                                        {{ $blog->created_at->format('H:i A') }}
                                    </li>
                                    <li><i class="fa fa-calendar"></i>
                                        {{ $blog->created_at->format('M d, Y') }}
                                    </li>
                                </ul>
                            </div>

                            {{-- Image --}}
                            <img src="{{ $blog->image }}" alt="" width="100%" style="margin-bottom: 10px">

                            {{-- Content --}}
                            <p>
                                {{ $blog->content }}
                            </p>

                            <div class="pager-area">
                                <ul class="pager pull-right">
                                    <li>
                                        @if ($previousBlog)
                                            <a href="{{ route('blogs.show', $previousBlog->slug) }}" class="prev-blog">
                                                ← Pre
                                            </a>
                                        @else
                                        @endif
                                    </li>
                                    <li>
                                        @if ($nextBlog)
                                            <a href="{{ route('blogs.show', $nextBlog->slug) }}" class="next-blog">
                                                Next →
                                            </a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="rating-area">
                        <ul class="ratings">
                            <li class="rate-this">Rate this item:</li>
                            <li>
                                @php
                                    $avgRating = round($blog->rates_avg_rating);
                                @endphp

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $avgRating)
                                        <i class="fa fa-star color"></i>
                                    @else
                                        <i class="fa fa-star"></i>
                                    @endif
                                @endfor
                            </li>
                            <li class="color">({{ $blog->rates_count }} rating)</li>
                        </ul>
                    </div>
                    {{-- <ul class="tag">
                        <li>TAG:</li>
                        <li><a class="color" href="">Pink <span>/</span></a></li>
                        <li><a class="color" href="">T-Shirt <span>/</span></a></li>
                        <li><a class="color" href="">Girls</a></li>
                    </ul> --}}

                    <div class="socials-share">
                        <a href="">
                            <img src="{{ asset('frontend/images/blog/socials.png') }}" alt="">
                        </a>
                    </div>
                </div>

                {{-- Comments --}}
                <div class="response-area">

                    @if ($blog->comments_count > 0)
                        <h2> {{ $blog->comments_count }} RESPONSES</h2>
                    @endif
                    <ul class="media-list" id="comment-list">

                    </ul>
                </div>
                <!--/Response-area-->

                <!--Reply Box-->
                <div class="replay-box">
                    <div class="row">
                        <div class="col-sm-12" style="padding: 10px; margin: 0 20px">
                            <div class="post-comment">
                                <h2>Leave a reply</h2>
                                @auth
                                    <div class="blank-arrow">
                                        <label>{{ Auth::user()->name }}</label>
                                    </div>
                                @else
                                    <div class="blank-arrow">
                                        <label class="text-muted">
                                            Please login to comment
                                        </label>
                                    </div>
                                @endauth
                                <span>*</span>

                                <textarea id="comment-message" name="content" rows="5" placeholder="Your comment"></textarea>
                                <input type="hidden" id="blog-id" value="{{ $blog->id }}">
                                <input type="hidden" id="parent-id" value="">

                                <button id="submit-comment" class="btn btn-primary">
                                    Post comment
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/Reply Box-->
            </div>
        </div>
        <script src="{{ asset('frontend/js/jquery-1.9.1.min.js') }}"></script>
        <script src="{{ asset('frontend/js/handle-comment.js') }}"></script>
    </section>
@endsection
