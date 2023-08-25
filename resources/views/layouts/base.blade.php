<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'save-text_and_save-file') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!--Styles-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" integrity="sha512-XWTTruHZEYJsxV3W/lSXG1n3Q39YIWOstqvmFsdNEEQfHoZ6vm6E9GK2OrF6DSJSpIbRbi+Nn0WDPID9O7xB2Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
    <script src="{{ asset('/resources/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js" integrity="sha512-ToL6UYWePxjhDQKNioSi4AyJ5KkRxY+F1+Fi7Jgh0Hp5Kk2/s8FD7zusJDdonfe5B00Qw+B8taXxF6CFLnqNCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        body{
            font-size: 18px;
        }
        img{
            width: 250px;
            height: 250px;
        }
        a{

            text-decoration: none;

        }
        .files:hover{
            color: #000000;
            opacity: 0.5;
        }
        .btn1{
            max-width: 100px;
            text-align: center;

        }
        .dd{
            display: flex;
            justify-content: space-between;
        }
        input{
            font-size: 20px;
        }
        .navbar{
            display: flex;
            justify-content: space-between;
        }
        .hover{
            display: flex;
            justify-content: flex-end;
            align-items: flex-end;
            text-align: end;
        }
    </style>
</head>
<body>
    @include('includes.header')
    <main class="d-flex flex-column min-vh-100 container" id="app">
        @yield('content')
    </main>
    @include('includes.footer')
</body>
</html>
