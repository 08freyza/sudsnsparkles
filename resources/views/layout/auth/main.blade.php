<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        @isset($title)
            <title>{{ $title . ' | ' . env('APP_NAME') }}</title>
        @else
            <title>{{ env('APP_NAME') . ' - ' . $titleStatement }}</title>
        @endisset

        {{-- Bootstrap 5.0.3 --}}
        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

        {{-- Google Fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        {{-- Sweet Alert CSS --}}
        <link href="{{ asset('assets/vendor/sweetalert/dist/sweetalert2.css') }}" rel="stylesheet">

        {{-- Custom CSS --}}
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

        <!-- Sweet Alert JS -->
        <script src="{{ asset('assets/vendor/sweetalert/dist/sweetalert2.all.js') }}"></script>
    </head>
    <body class="vh-100">

        <main id="main-section" class="h-100">

            <div class="container h-100">
                @if (session('message'))
                    <div id="message-notify" class="d-none">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11 pt-2 pb-1">
                        <!-- start header -->
                        @include('layout/auth/header')
                        <!-- end header -->

                        <!-- start content -->
                        @yield('content')
                        <!-- end content -->

                        <!-- start footer -->
                        @include('layout/auth/footer')
                        <!-- end footer -->

                    </div>
                </div>

            </div>
        </main>

        {{-- Bootstrap 5.0.3 --}}
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        {{-- Custom JS --}}
        <script src="{{ asset('assets/js/main.js') }}"></script>

        {{-- Custom Sweet Alert JS --}}
        <script src="{{ asset('assets/js/message.js') }}"></script>
    </body>
</html>
