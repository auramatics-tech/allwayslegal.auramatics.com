<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('assets/frontend/media/favicon-16x16.png') }}" type="image/gif" sizes="16x16">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dashboard') }}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <!-- Font Icon CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/default-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/dashboard.css') }}">
    <style>
        .top_space {
            margin-top: 90px
        }
        header {
            background: rgba(255, 255, 255, 1);
        }
    </style>
    @yield('css')
</head>

<body>
    <div id="dashboard">
        @include('booking.includes.header')
        <main class="top_space">
            <div class="container-fluid py-lg-5 py-4 px-0">
                <div class="d-flex">
                    <div class="col_sidebar">
                        @if (Route::is('lawyer.*') || Route::is('client.*') || Route::is('dashboard.*'))
                            @include('booking.includes.dashboard_sidebar')
                        @elseif(Route::is('booking_summary'))
                        @else
                            @include('booking.includes.sidebar')
                        @endif
                    </div>
                    <div   @if(!Route::is('booking_summary')) id="content" @endif class="px-xl-4 px-3">
                        @yield('content')
                    </div>
                </div>
            </div>

        </main>
        <div id="footer">
            @include('frontend.layouts.footer')
        </div>
    </div>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="{{ asset('assets/frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery-plugin-collection.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/script.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#profile_photo_path').on('change', function() {
                var file = $(this)[0].files[0];
                var formData = new FormData();
                formData.append('profile_photo_path', file);

                // Retrieve the CSRF token from the meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Include the CSRF token in the AJAX request headers
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                $.ajax({
                    url: '{{ url('/upload-profile') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('Image uploaded successfully');
                        location.reload(true);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error uploading image:', error);
                    }
                });
            });
        });
        $(document).ready(function() {
            // Bind the click event to the #toggle_btn element
            $('#toggle_btn').click(function(event) {
                console.log("ncxbv");
                $("#dashboard_sidebar").toggleClass("active");

                if ($("#dashboard_sidebar").hasClass("active")) {
                    $(".txt_span").removeClass('d-sm-inline');
                    $("#content").addClass('fullwidth');
                } else {
                    $(".txt_span").addClass('d-sm-inline');
                    $("#content").removeClass('fullwidth');
                }
            });
        });
    </script>
    @yield('script')
</body>

</html>
