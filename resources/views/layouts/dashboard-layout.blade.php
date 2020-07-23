<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('theme/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('theme/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('theme/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('theme/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('theme/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('theme/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{asset('theme/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}  " rel="stylesheet" media="all">
    <link href="{{ asset('theme/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('theme/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{asset('theme/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('theme/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{asset('theme/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('theme/css/theme.css')}}" rel="stylesheet" media="all">

	{{-- Script do tiny MCE	--}}
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>tinymce.init({selector:'textarea'});</script>

</head>'

<body class="animsition">
    <div class="page-wrapper">

        @include('layouts.header-mobile')

        @include('layouts.sidebar');

        <!-- PAGE CONTAINER-->
        <div class="page-container">

            @include('layouts.header-desktop')

           {{-- Conteúdo principal --}}
            <div class="main-content">
                <div class="section__content section__content--p30">
                    @yield('conteudo')
                </div>
            </div>

            {{-- Footer --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery JS-->
    {{-- <script src="{{ asset('theme/vendor/jquery-3.2.1.min.js')}}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
    <script src="{{asset('site/js/tags.js')}}"></script>

    <!-- Bootstrap JS-->
    <script src="{{asset('theme/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('theme/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{asset('theme/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('theme/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{asset('theme/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{asset('theme/vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{asset('theme/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{asset('theme/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('theme/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/select2/select2.min.js') }}">
    </script>
    <script src="{{asset('theme/vendor/animsition/animsition.min.js')}}"></script>
    <!-- Main JS-->
    <script src="{{asset('theme/js/main.js')}}"></script>


</body>
</html>
