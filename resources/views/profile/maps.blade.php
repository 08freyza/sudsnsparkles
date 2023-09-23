@extends('layout.main')

@push('link')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script type="module" src="{{ asset('assets/js/gmaps.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endpush

@section('content')
<div class="container h-100">

    <section id="profile" class="pt-4 pb-5">
        <div class="row align-items-center">
            <div class="col-lg-6 col-12 text-lg-start text-center">
                <h1 class="fw-semibold fs-40 text-navysky mb-lg-4 mb-1">{{ $title }}</h1>
            </div>
            <div class="col-lg-6 col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-lg-end float-none justify-content-lg-none justify-content-center mb-lg-none mb-4">
                        <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item">
                            <a
                                class="text-decoration-none"
                                href="{{ url((session('username') == 'admin' ? 'admin' : '') . '/' . 'profile') }}"
                            >
                                Profile
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <form action="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/profile/edit-address-process') }}" method="POST">
            @csrf

            <div class="d-none" id="latlng" data-lat="{{ $profile['latitude'] }}" data-lng="{{ $profile['longitude'] }}"></div>
            <div class="row">
                <div class="col-12">
                    <div class="my-2 pb-1">
                        <label for="address" class="fw-medium fs-17">Address</label>
                        <textarea class="form-control px-3 py-2 @error('address') is-invalid @enderror" id="address" name="address" placeholder="Your address" rows="4">{{ old('address') ?? $profile['address'] }}</textarea>
                        @error('address')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <input type="text" class="form-control px-3 py-2" id="latitude" name="latitude" placeholder="" value="" hidden>
                    <input type="text" class="form-control px-3 py-2" id="longitude" name="longitude" placeholder="" value="" hidden>
                </div>
            </div>

            <div id="map"></div>

            <div class="row">
                <div class="col-12 d-md-block d-none">
                    <div class="my-2 pb-1">
                        <div class="change-data d-flex justify-content-end">
                            <a class="btn btn-outline-danger w-25 py-2 mt-4 me-2 mb-1" href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/profile') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary w-25 py-2 mt-4 ms-2 my-1">Update Address</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-md-none d-block">
                    <div class="my-2 pb-0">
                        <div class="change-data d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary w-100 py-2 mt-4">Update Address</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-md-none d-block">
                    <div class="mt-0 mb-2 pb-1">
                        <div class="change-data d-flex justify-content-end">
                            <a class="btn btn-outline-danger w-100 py-2 mt-0 mb-1" href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/profile') }}">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div id="text"></div>
    </section>

</div>
@endsection

@push('script')
<script>
    (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
    ({key: "AIzaSyCuN63dkeBKLJH8vS5hjLt8zRUHo9Ye3kw", v: "weekly"});
</script>
@endpush
