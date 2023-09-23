@extends('layout.main')

@push('link')
@endpush

@section('content')
<div class="container">

    <section id="home-main" class="pt-xl-3 pt-lg-5 pt-1 pb-3 mt-xl-0 mt-lg-4 mt-0">
        <div class="row gx-sm-5 gx-0 align-items-center pb-md-4 pb-1 pt-xl-3 pt-md-0 pt-1 mt-lg-5 mt-md-4 mt-3 mb-lg-4 mb-2">
            <div class="col-lg-6 col-12 text-lg-start text-center">
                <h1 class="mx-0 mb-0 mt-lg-0 mt-4 fw-bold fs-42 text-navysky d-lg-block d-none">Your Clean Clothes <br class="d-lg-inline d-none">Start From Here</h1>
                <h1 class="mx-0 mb-0 mt-0 fw-bold fs-42 text-navysky d-lg-none d-block">Get Your Clothes Clean Now</h1>

                <p class="mt-4 mb-4 pb-lg-3 pb-2 fs-16 text-specialgrey fw-light">We can make your clothes clean and <br class="d-lg-inline d-none">colorful that you never expected before, <br class="d-lg-inline d-none">make your life better and memorable.</p>
                @if (Auth::guard('admin')->check() == false && Auth::guard('customer')->check() == false)
                    <a class="btn btn-primary px-5 py-2" href="{{ url('login') }}">Login Now</a>
                @else
                    <a class="btn btn-primary px-5 py-2" href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : 'dashboard')) }}">Get Started</a>
                @endif

                <img class="img-fluid rounded w-100 d-sm-none d-block mx-auto mt-5 mb-sm-0 mb-2" src="{{ asset('assets/img/wm.jpg') }}" alt="main-image">
                <img class="img-fluid rounded w-100 d-md-none d-sm-block mx-auto mt-5 d-none mb-md-0 mb-2" src="{{ asset('assets/img/wm.jpg') }}" alt="main-image">
                <img class="img-fluid rounded w-100 d-lg-none d-md-block mx-auto mt-5 d-none mb-lg-0 mb-2" src="{{ asset('assets/img/wm.jpg') }}" alt="main-image">
            </div>
            <div class="col-6 d-xl-flex d-none justify-content-end">
                <div class="z-1 me-5 position-absolute" style="width: 520px; height: 411px;">
                    <img class="border-radius-home-1" src="{{ asset('assets/img/wm.jpg') }}" alt="main-image">
                </div>
                <div class="z-4 d-xl-block d-none mt-5 border border-2 border-radius-home-1" style="width: 520px; height: 411px;"></div>
            </div>
            <div class="col-lg-6 col-12 d-xl-none d-lg-flex d-none justify-content-end">
                <div>
                    <img class="img-fluid border-radius-home-1" src="{{ asset('assets/img/wm.jpg') }}" alt="main-image">
                </div>
            </div>
        </div>
    </section>

    <section id="why-choose-us-main" class="py-3">
        <div class="row gx-sm-5 gx-0 align-items-center py-1 mt-2 mb-md-5 mb-0">
            <div class="col-12 py-1 title-why-choose-us" data-aos="fade-up">
                <h1 class="fw-semibold fs-40 text-navysky text-center mb-4">Why Choose Us?</h1>
            </div>
            <div class="col-md-6 col-12 mt-5 py-1 text-md-start text-center" data-aos="flip-left">
                <img class="img-fluid d-md-inline d-none border-radius-home-2 my-0 w-100 h-100 w-special-img" src="{{ asset('assets/img/hero1.jpg') }}" alt="main-image">
                <img class="img-fluid d-md-none d-inline rounded my-0 w-100 h-100 w-special-img" src="{{ asset('assets/img/hero1.jpg') }}" alt="main-image">
            </div>
            <div class="col-md-6 col-12 mt-md-5 mt-3 py-1" data-aos="flip-left">
                <h1 class="m-0 text-md-start text-center fw-semibold fs-40 text-bluesky">Bright & Colorful</h1>
                <p class="mt-4 text-md-start text-center fs-16 text-specialgrey">We try to keep your clothes colorful and bright, so you can wear it freely.</p>
            </div>
            <div class="col-md-6 col-12 mt-md-5 mt-3 py-1 order-md-1 order-2" data-aos="flip-left">
                <h1 class="m-0 text-md-end text-center fw-semibold fs-40 text-bluesky">Fast & Clean</h1>
                <p class="mt-4 text-md-end text-center fs-16 text-specialgrey">We guarantee to clean your clothes as fast as we can without damaging them.</p>
            </div>
            <div class="col-md-6 col-12 mt-5 py-1 order-md-2 order-1 d-flex justify-content-md-end justify-content-center" data-aos="flip-left">
                <img class="img-fluid d-md-inline d-none border-radius-home-3 my-0 w-100 h-100 w-special-img" src="{{ asset('assets/img/hero2.jpg') }}" alt="main-image">
                <img class="img-fluid d-md-none d-inline rounded my-0 w-100 h-100 w-special-img" src="{{ asset('assets/img/hero2.jpg') }}" alt="main-image">
            </div>
            <div class="col-md-6 col-12 mt-5 py-1 order-md-3 order-3 text-md-start text-center" data-aos="flip-left">
                <img class="img-fluid d-md-inline d-none border-radius-home-2 my-0 w-100 h-100 w-special-img" src="{{ asset('assets/img/hero3.jpg') }}" alt="main-image">
                <img class="img-fluid d-md-none d-inline rounded my-0 w-100 h-100 w-special-img" src="{{ asset('assets/img/hero3.jpg') }}" alt="main-image">
            </div>
            <div class="col-md-6 col-12 mt-md-5 mt-3 py-1 order-md-4 order-4" data-aos="flip-left">
                <h1 class="m-0 text-md-start text-center fw-semibold fs-40 text-bluesky">Delivery Service</h1>
                <p class="mt-4 text-md-start text-center fs-16 text-specialgrey">We can send your clothes to your place, so that you can save your time and enjoy.</p>
            </div>
        </div>
    </section>

    <section id="about-us-main" class="py-3">
        <div class="row gx-sm-5 gx-0 align-items-center py-1 mt-2 mb-md-5 mb-3" data-aos="fade-up">
            <div class="col-12 py-1 title-about-us">
                <h1 class="fw-semibold fs-40 text-navysky text-center mb-4">About Us</h1>
            </div>
            <div class="col-md-6 col-12 mt-5">
                <div class="row gy-3 gx-4" data-aos="zoom-in">
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded rounded-4 w-100" src="{{ asset('assets/img/about1.png') }}" alt="main-image" width="125" height="125" />
                    </div>
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded rounded-4 w-75" src="{{ asset('assets/img/about2.jpg') }}" alt="main-image" width="125" height="125" style="margin-top: 25%" />
                    </div>
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded rounded-4 w-75" src="{{ asset('assets/img/about3.png') }}" alt="main-image" width="125" height="125" />
                    </div>
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded rounded-4 w-100" src="{{ asset('assets/img/about4.jpg') }}" alt="main-image" width="125" height="125" />
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 mt-5 text-md-start text-center" data-aos="fade-up">
                <p class="fs-20 mt-md-4 mt-0 mb-4 text-specialgrey fw-light">We are <span class="fw-medium text-bluesky">{{ Str::substr(env('APP_NAME'), 0, 4) }}</span><span class="fw-medium text-navysky">{{ Str::substr(env('APP_NAME'), 4, 8) }}</span> Laundry. Established in 2020. Our location is in South Jakarta, Jakarta, Indonesia. We have been providing our customers around Jakarta.</p>
                <p class="fs-20 my-4 text-specialgrey fw-light">We keep our customers believe in us. We try to do the best for them and we always help them whenever they need.</p>
            </div>
        </div>
    </section>

</div>
@endsection

@push('script')
@endpush
