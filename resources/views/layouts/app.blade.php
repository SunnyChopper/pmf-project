<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- Title Page-->
    <title>{{ $page_title }}</title>

    <!-- Fontfaces CSS-->
    <link href="{{ URL::asset('css/font-face.css?v=1') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/font-awesome-4.7/css/font-awesome.min.css?v=1') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/font-awesome-5/css/fontawesome-all.min.css?v=1') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/mdi-font/css/material-design-iconic-font.min.css?v=1') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ URL::asset('vendor/bootstrap-4.1/bootstrap.min.css?v=1') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ URL::asset('vendor/animsition/animsition.min.css?v=1') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css?v=1') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/wow/animate.css?v=1') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/css-hamburgers/hamburgers.min.css?v=1') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/slick/slick.css?v=1') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/select2/select2.min.css?v=1') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/perfect-scrollbar/perfect-scrollbar.css?v=1') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ URL::asset('css/theme.css?v=1') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('css/style.css?v=1') }}" rel="stylesheet" media="all">

</head>
<body class="animsition">
    @extends('layouts.js')
    <div class="page-wrapper">
        @extends('layouts.navbar')

        <div class="page-container">
            @extends('layouts.header')
             <div class="main-content">
                <div class="section__content section__content--p30">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>