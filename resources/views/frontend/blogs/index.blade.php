@extends('frontend.layouts.layout')

@section('content')
    {{-- @include('frontend.layouts.left-sidebar') --}}
    <div class="col-sm-12">
        <div class="blog-post-area">
            <h2 class="title text-center">Latest From our Blog</h2>
            @foreach ($blogs as $blog)
                <div class="single-blog-post">
                    {{-- Title --}}
                    <h3>{{ $blog->title }}</h3>

                    {{-- Author & Post Date --}}
                    <div class="post-meta">
                        <ul>
                            <li><i class="fa fa-user"></i> {{ $blog->user->name }}</li>
                            <li><i class="fa fa-clock-o"></i> {{ $blog->created_at->format('h:i A') }}</li>
                            <li><i class="fa fa-calendar"></i> {{ $blog->created_at->format('M d, Y') }}</li>
                        </ul>
                        {{-- Rating --}}
                        <div class="rate" data-blog="{{ $blog->id }}" data-rate="{{ $blog->rates_avg_rating }}"
                            style="float: right">
                            <div class="vote rating-inline" style=" display: flex; align-items: center; gap: 8px;">
                                <div class="rating-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="ratings_stars" data-value="{{ $i }}">
                                        </span>
                                    @endfor
                                </div>

                                | <span class="rating-text" style="font-style: italic">
                                    {{ $blog->rates_count }} rating
                                </span>
                            </div>
                        </div>

                    </div>

                    {{-- Image --}}
                    <a href="{{ route('blogs.show', $blog->slug) }}">
                        <img src="{{ $blog->image }}" alt="">
                    </a>


                    {{-- Content --}}
                    <p>{{ $blog->content }}</p>

                    <a class="btn btn-primary" href="/blog/{{ $blog->slug }}">Read More</a>
                </div>
            @endforeach

            <div class="justify-content-center" style="margin-top: 12px; padding-left: 0px;">
                {{ $blogs->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    </section>
    <script src="{{ asset('frontend/js/jquery-1.9.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/handle-rating.js') }}"></script>
    <script src="{{ asset('frontend/js/load-rating.js') }}"></script>
@endsection
