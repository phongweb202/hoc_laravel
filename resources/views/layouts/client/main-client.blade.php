<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="{{asset('storage/img/fevicon.png')}}" type="image/png" />
    <title>Eiser ecommerce</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('storage/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('storage/vendors/linericon/style.css')}}" />
    <link rel="stylesheet" href="{{asset('storage/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('storage/css/themify-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('storage/css/flaticon.css')}}" />
    <link rel="stylesheet" href="{{asset('storage/vendors/owl-carousel/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('storage/vendors/lightbox/simpleLightbox.css')}}" />
    <link rel="stylesheet" href="{{asset('storage/vendors/nice-select/css/nice-select.css')}}" />
    <link rel="stylesheet" href="{{asset('storage/vendors/animate-css/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('storage/vendors/jquery-ui/jquery-ui.css')}}" />
    <!-- main css -->
    <link rel="stylesheet" href="{{asset('storage/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('storage/css/responsive.css')}}" />

    <style>
        a {
            cursor: pointer;
        }
    </style>
</head>

<body>
    @include('layouts/client/header-client')
    @yield('content')
    @include('layouts/client/footer-client')
    <script src="{{asset('storage/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('storage/js/popper.js')}}"></script>
    <script src="{{asset('storage/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('storage/js/stellar.js')}}"></script>
    <script src="{{asset('storage/vendors/lightbox/simpleLightbox.min.js')}}"></script>
    <script src="{{asset('storage/vendors/nice-select/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('storage/vendors/isotope/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('storage/vendors/isotope/isotope-min.js')}}"></script>
    <script src="{{asset('storage/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('storage/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('storage/vendors/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('storage/vendors/counter-up/jquery.counterup.js')}}"></script>
    <script src="{{asset('storage/js/mail-script.js')}}"></script>
    <script src="{{asset('storage/js/theme.js')}}"></script>
</body>

</html>