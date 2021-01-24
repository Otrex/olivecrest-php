<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @section('meta')
        @show
        <!-- Title -->
        <title> OliveCrest | @yield('title') </title>

        <!-- Logo -->
        <link rel="icon" href="/img/logo1.svg" type="image/svg" >

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,700;1,200;1,300&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /* Default Font */
            * {font-family: 'Poppins', sans-serif;}
        </style>
        <link href="/css/style.css" rel="stylesheet" />
        @section('style')
        @show
    </head>
    <body class="body">
        <div id='app'></div>
        <!-- built files will be auto injected -->
        @section('body')
        @show


        @section('script')
        @show
        <script src="/js/extra.js"></script>
        <noscript>
          <strong>We're sorry but <%= htmlWebpackPlugin.options.title %> doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
        </noscript>
    </body>
</html>
