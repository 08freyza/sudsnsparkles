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

        <!-- start link -->
        @include('layout/partials/link')
        <!-- end link -->

        <!-- Sweet Alert JS -->
        <script src="{{ asset('assets/vendor/sweetalert/dist/sweetalert2.all.js') }}"></script>
    </head>
    <body>

        {{-- Loader --}}
        <div class="spinner-wrapper">
            <div class="spinner-border text-primary" role="status">
                <div class="visually-hidden">Loading...</div>
            </div>
        </div>

        <!-- start header -->
        @include('layout/partials/header')
        <!-- end header -->

        <main id="{{ session('username') ? 'main-section-log' : 'main-section' }}" class="mt-5 pt-5">

            @if (session('message'))
                <div id="message-notify" class="d-none">
                    {{ session('message') }}
                </div>
            @endif
            @if (session('additionalmessage'))
                <div id="message-notify-add" class="d-none">
                    {{ session('additionalmessage') }}
                </div>
            @endif

            <!-- start content -->
            @yield('content')
            <!-- end content -->

        </main>

        <!-- start footer -->
        @include('layout/partials/footer')
        <!-- end footer -->

        <!-- start script -->
        @include('layout/partials/script')
        <!-- end script -->
    </body>
</html>
