<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>
    
     {{-- Fontawesome CDN Link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
    <!-- Fontfaces CSS-->
    <link href="{{asset('dashboard/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('dashboard/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('dashboard/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('dashboard/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    {{-- Bootstrap5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <!-- Bootstrap CSS-->
    <link href="{{asset('dashboard/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset('dashboard/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('dashboard/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('dashboard/vendor/wow/animate.css" rel="stylesheet')}}" media="all">
    <link href="{{asset('dashboard/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('dashboard/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('dashboard/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('dashboard/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('dashboard/css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        @yield('content')
    </div>

    <script src="{{asset('dashboard/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('dashboard/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('dashboard/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{asset('dashboard/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('dashboard/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('dashboard/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('dashboard/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{asset('dashboard/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('dashboard/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{asset('dashboard/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('dashboard/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('dashboard/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('dashboard/vendor/select2/select2.min.js')}}">
    </script>

    {{-- Fontawesome CDN js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Main JS-->
    <script src="{{asset('dashboard/js/main.js')}}"></script>



</body>
@stack('custom-js')

</html>
<!-- end document-->
