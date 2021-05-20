
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>teste</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin_pub/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin_pub/css/sb-admin-2.min.css')}}" rel="stylesheet">    

    
    <!-- Styles -->
    
    @yield('css')
    
    @yield('head')
</head>

<body>
    @include('back_layouts.navbar')

    

    @yield('content')

    {{-- @include('front_layouts.footer') --}}

    <!-- Scripts-->
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin_pub/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('admin_pub/vendor/bootstrap/js/bootstrap.bundle.min.js')}}" ></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin_pub/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin_pub/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('admin_pub/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('admin_pub/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{ asset('admin_pub/js/demo/chart-pie-demo.js')}}"></script>
    @yield('scripts')
    @include('back_layouts.footer')
</body>

</html>
