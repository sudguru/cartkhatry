<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('pagetitle')
    </title>

    <meta name="keywords" content="local market - should be dynamic" />
    <meta name="description" content="shold be dynamic">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/icons/favicon.ico') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/solid.css" integrity="sha384-osqezT+30O6N/vsMqwW8Ch6wKlMofqueuia2H7fePy42uC05rm1G+BUPSd2iBSJL" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/fontawesome.css" integrity="sha384-BzCy2fixOYd0HObpx3GMefNqdbA7Qjcc91RgYeDjrHTIEXqiF00jKvgQG0+zY/7I" crossorigin="anonymous">
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style_blue.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom_blue.css') }}">
    <style>
        .header-contact {
            padding-right: 0;
            margin-right: 0;
        }
        .header-contact::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            display: block;
            width: 1px;
            height: 43px;
            margin-top: -21.5px;
            background-color: #ffffff;
        }
        .header-middle {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        @media screen and (max-width: 767px) {
            .header-contact {
                display: inline-block;
            }
            .header-middle .header-right {
                margin-left: auto;
            }
        }

        @media screen and (max-width: 991px) {
            .header-middle .header-right {
                margin-left: auto;
            }
        }
    </style>

    @yield('extracss')

</head>
<body>

<div class="page-wrapper">
        
        @include('admin.partials.header_thok')
        
        <main class="main">
                <div class="container">
                        <div class="mb-1"></div>
                    @yield('content')
                </div>
        </main>

        @include('admin.partials.footer')
        
    </div>

    @include('admin.partials.mobile-menu')

    <!-- Scripts -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.min.js') }}"></script>
    <script src="{{ asset('assets/js/ticker.js') }}"></script>
    @php
    $cur = $_GET['cur'] ?? 'NPR';
    $cur = filter_var($cur, FILTER_SANITIZE_STRING);
    @endphp
    <script>
        var cur = "{{ $cur }}";
    </script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @yield('extrajs')
</body>
</html>