@extends('frontend.layouts.layout')

@section('content')
    @include('frontend.layouts.left-sidebar')
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
        <ul class="media-list" id="comment-list"></ul>
    </div>
    <!--/Comments-->

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
    <script src="{{ asset('frontend/js/jquery-1.9.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/handle-comment.js') }}"></script>
@endsection
