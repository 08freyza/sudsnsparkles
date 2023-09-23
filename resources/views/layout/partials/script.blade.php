{{-- Bootstrap 5.0.3 --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

{{-- Jquery --}}
<script src="<?= asset('assets/vendor/jquery/jquery.min.js') ?>"></script>

{{-- Jquery --}}
<script src="<?= asset('assets/vendor/aos/dist/aos.js') ?>"></script>

{{-- Custom JS --}}
<script src="{{ asset('assets/js/main.js') }}"></script>

{{-- Custom Sweet Alert JS --}}
<script src="{{ asset('assets/js/message.js') }}"></script>

<script>
    AOS.init({
        duration: 800,
    })
</script>

@stack('script')
