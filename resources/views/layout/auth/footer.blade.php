<div class="footer-bottom pt-4 mt-0">
    <div class="container footer-bottom clearfix pb-4">
        <div class="copyright text-center text-speciallightgrey fw-light">
            &copy; {{ date('Y') }} {{ env('APP_NAME') }}. All Rights Reserved.
        </div>
        <div class="credits text-center text-speciallightgrey fw-light">
            Made by {{ Str::replace('_', ' ', env('APP_AUTHOR_NAME')) }}
        </div>
    </div>
</div>
