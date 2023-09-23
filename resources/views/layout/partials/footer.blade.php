<footer id="footer-main">
    <div class="footer-top border-top pt-3">
        <div class="container py-md-5 py-4">
            <div class="row gx-sm-5 gx-0">

                <div class="col-lg-3 col-md-6 footer-company">
                    <h1 class="fs-26 fw-medium">
                        <span class="text-bluesky">{{ Str::substr(env('APP_NAME'), 0, 4) }}</span><span class="text-navysky">{{ Str::substr(env('APP_NAME'), 4, 8) }}.</span>
                    </h1>
                    <p class="text-speciallightgrey fw-light">
                        We help you to clean your clothes
                        and become brighter
                        and colorful
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 footer-address">
                    <h4 class="fs-18 pt-2">Address</h4>
                    <p class="text-speciallightgrey fw-light">
                        Kasablanka Road,
                        South Jakarta, Jakarta,
                        14230
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 footer-workhour">
                    <h4 class="fs-18 pt-2">Open Hours</h4>
                    <p class="text-speciallightgrey fw-light">
                        Everyday<br>
                        09.00 - 22.00 WIB
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4 class="fs-18 pt-2">Contact Us</h4>
                    <p class="text-speciallightgrey fw-light">
                        Telephone: +62 21 8324 667<br>
                        Whatsapp: +62 812 3243 2202
                    </p>
                </div>

            </div>
        </div>
    </div>

    <div class="container footer-bottom clearfix pb-4">
        <div class="copyright text-center text-speciallightgrey fw-light">
            &copy; {{ date('Y') }} {{ env('APP_NAME') }}. All Rights Reserved.
        </div>
        <div class="credits text-center text-speciallightgrey fw-light">
            Made by {{ Str::replace('_', ' ', env('APP_AUTHOR_NAME')) }}
        </div>
    </div>
</footer>
