@extends('layout.main')

@push('link')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script type="module" src="{{ asset('assets/js/gmaps.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endpush

@section('content')
<div class="container">

    <section id="customer" class="pt-4 pb-5">
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
                                href="{{ url((session('username') == 'admin' ? 'admin' : '') . '/' . explode(' ', strtolower($title))[1]) }}"
                            >
                                {{ explode(' ', $title)[1] }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <form action="{{ url('admin/customer/' . $customer['id']) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="d-none" id="latlng" data-lat="{{ $customer['latitude'] }}" data-lng="{{ $customer['longitude'] }}"></div>
            <input type="text" id="id" name="id" value="{{ $customer['id'] }}" hidden>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="mb-2 pb-1">
                        <label for="name" class="fw-medium fs-17">Name</label>
                        <input type="text" class="form-control px-3 py-2 @error('name') is-invalid @enderror" id="name" name="name" placeholder="Your name" value="{{ old('name') ?? $customer->name }}">
                        @error('name')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="my-2 pb-1">
                        <label for="gender" class="fw-medium fs-17">Gender</label>
                        <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                            <option value="" {{ old('gender') == '' ? 'selected' : ($customer->gender == '' ? 'selected' : '') }} disabled>Choose Gender...</option>
                            @foreach (['male', 'female'] as $gender)
                                <option value="{{ $gender }}" {{ old('gender') == $gender ? 'selected' : ($customer->gender == $gender ? 'selected' : '') }}>
                                    {{ Str::title($gender) }}
                                </option>
                            @endforeach
                        </select>
                        @error('gender')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="my-2 pb-1">
                        <label for="address" class="fw-medium fs-17">Address</label>
                        <textarea class="form-control px-3 py-2" id="address" name="address" placeholder="Your address" rows="4">{{ old('address') ?? $customer->address }}</textarea>
                    </div>
                    <div class="mb-2 pb-1">
                        <label for="phone_number" class="fw-medium fs-17">Phone Number</label>
                        <input type="text" class="form-control px-3 py-2 @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" placeholder="Your phone number" value="{{ old('phone_number') ?? $customer->phone_number }}">
                        @error('phone_number')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2 pb-1">
                        <label for="username" class="fw-medium fs-17">Username</label>
                        <input type="text" class="form-control px-3 py-2" id="username" placeholder="Your username" value="{{ $customer->username }}" disabled>
                        <div id=" validationServer03Feedback" class="text-secondary fs-13">
                            You can't change user's username
                        </div>
                    </div>
                    <input type="text" class="form-control px-3 py-2" id="latitude" name="latitude" placeholder="" value="" hidden>
                    <input type="text" class="form-control px-3 py-2" id="longitude" name="longitude" placeholder="" value="" hidden>
                    <div class="mb-2 pb-1">
                        <label for="email" class="fw-medium fs-17">Email</label>
                        <input type="text" class="form-control px-3 py-2 @error('email') is-invalid @enderror" id="email" name="email" placeholder="Your email" value="{{ old('email') ?? $customer->email }}">
                        @error('email')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2 mt-4 pb-1 d-lg-block d-none">
                        <button type="submit" class="btn btn-primary w-100 py-2 mt-2 my-1">{{ $title }}</button>
                        <a class="btn btn-outline-danger w-100 py-2 mt-1 mb-1" href="{{ url('admin/customer') }}">Cancel</a>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div id="map" class="mt-lg-0 mt-3"></div>
                    <p class="my-2 p-0">Position will be determined if you're trying to click randomly on the map. If you don't want to set the position, click reset position!</p>
                    <a href="javascript.void(0)" id="reset-position" class="btn btn-secondary w-100 py-2 mt-1 mb-1">Reset Position</a>
                    <div class="mb-2 mt-4 pb-1 d-lg-none d-block">
                        <button type="submit" class="btn btn-primary w-100 py-2 mt-2 my-1">{{ $title }}</button>
                        <a class="btn btn-outline-danger w-100 py-2 mt-1 mb-1" href="{{ url('admin/customer') }}">Cancel</a>
                    </div>
                </div>
            </div>

        </form>
    </section>

</div>
@endsection

@push('script')
<script>
    (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
    ({key: "AIzaSyCuN63dkeBKLJH8vS5hjlIll.Lt8zRUHo9Ye3kw", v: "weekly"});
</script>
@endpush
