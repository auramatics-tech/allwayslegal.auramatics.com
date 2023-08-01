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
    </style>
    @yield('css')
</head>

<body>
    <div id="dashboard">
        @include('frontend.layouts.header')
        <main class="top_space">
            @yield('content')
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
              url: '{{ url("/upload-profile") }}',
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
        
        
        </script>
    @yield('script')
</body>

</html>
