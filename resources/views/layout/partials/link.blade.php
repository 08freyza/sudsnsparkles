{{-- Logo --}}
<link rel="icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">

{{-- Bootstrap 5.0.3 --}}
<link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

{{-- Google Fonts --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

{{-- Sweet Alert CSS --}}
<link href="{{ asset('assets/vendor/sweetalert/dist/sweetalert2.css') }}" rel="stylesheet">

{{-- AOS CSS --}}
<link href="{{ asset('assets/vendor/aos/dist/aos.css') }}" rel="stylesheet">

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- Custom CSS --}}
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

@stack('link')
