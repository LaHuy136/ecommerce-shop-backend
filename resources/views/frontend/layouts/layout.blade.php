<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/prettyPhoto.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/price-range.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/rate.css') }}">
    <title>@yield('title')</title>
</head>

<body>
    @include('frontend.layouts.header')
    <section style="margin-bottom: 20px">
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

                @yield('content')
            </div>
        </div>
    </section>
    @include('frontend.layouts.footer')
</body>


<script src="{{ asset('frontend/js/jquery.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    window.rateUrl = "{{ route('rate.store') }}";
    window.commentStoreUrl = "{{ route('comments.store') }}";
    window.cartAddUrl = "{{ route('cart.store') }}";
    window.isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
</script>

<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('frontend/js/price-range.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>

</html>
