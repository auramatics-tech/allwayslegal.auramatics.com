<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('assets/frontend/media/favicon-16x16.png') }}" type="image/gif" sizes="16x16">
    <title>Allways-Legal</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <!-- Font Icon CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <!-- Plugin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slicknav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.carousel.min.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/default.css') }}?time={{date('U')}}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/default-responsive.css') }}?time={{date('U')}}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}?time={{date('U')}}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}?time={{date('U')}}">
</head>

<body class="antialiased">
    <div id="wrapper">
        @include('frontend.layouts.header')
        @yield('content')
        @include('frontend.layouts.footer')
    </div>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="{{ asset('assets/frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery-plugin-collection.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/script.js') }}"></script>
</body>

</html>
