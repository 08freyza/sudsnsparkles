@extends('layout.main')

@push('link')
@endpush

@section('content')
<div class="container">

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

        <form action="{{ url('admin/customer') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="mb-2 pb-1">
                        <label for="name" class="fw-medium fs-17">Name</label>
                        <input type="text" class="form-control px-3 py-2 @error('name') is-invalid @enderror" id="name" name="name" placeholder="Your name" value="{{ old('name') }}">
                        @error('name')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2 pb-1">
                        <label for="gender" class="fw-medium fs-17">Gender</label>
                        <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                            <option value="" {{ old('gender') == '' ? 'selected' : '' }} disabled>Choose Gender...</option>
                            @foreach (['male', 'female'] as $gender)
                                <option value="{{ $gender }}" {{ old('gender') == $gender ? 'selected' : '' }}>
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
                        <textarea class="form-control px-3 py-2" id="address" name="address" placeholder="Your address" rows="4">{{ old('address') }}</textarea>
                    </div>
                    <div class="mb-2 pb-1">
                        <label for="phone_number" class="fw-medium fs-17">Phone Number</label>
                        <input type="text" class="form-control px-3 py-2 @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" placeholder="Your phone number" value="{{ old('phone_number') }}">
                        @error('phone_number')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2 pb-1">
                        <label for="username" class="fw-medium fs-17">Username</label>
                        <input type="text" class="form-control px-3 py-2 @error('username') is-invalid @enderror" id="username" name="username" placeholder="Your username" value="{{ old('username') }}">
                        @error('username')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2 pb-1">
                        <label for="email" class="fw-medium fs-17">Email</label>
                        <input type="text" class="form-control px-3 py-2 @error('email') is-invalid @enderror" id="email" name="email" placeholder="Your email" value="{{ old('email') }}">
                        @error('email')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2 pb-1">
                        <label for="password" class="fw-medium fs-17">Password</label>
                        <input type="password" class="form-control px-3 py-2 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Your password" value="123456" readonly>
                        @error('password')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2 pb-1">
                        <label for="password_confirmation" class="fw-medium fs-17">Confirm Password</label>
                        <input type="password" class="form-control px-3 py-2 @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Your password confirmation" value="123456" readonly>
                        @error('password_confirmation')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="my-2 pb-1">
                        <button type="submit" class="btn btn-primary w-100 py-2 mt-2 my-1">{{ $title }}</button>
                        <a class="btn btn-outline-danger w-100 py-2 mt-1 mb-1" href="{{ url('admin/customer') }}">Cancel</a>
                    </div>
                </div>
                <div class="col-4 d-lg-block d-none">
                    <div class="position-relative">
                        <img class="z-3 position-absolute top-0 end-0 mt-5 me-5 rounded-3 border" src="{{ asset('assets/img/category2.webp') }}" alt="main-image" width="225" height="315">
                        <div class="z-2 position-absolute p-5 top-0 end-0 ms-5 rounded-3 border border-2" style="width: 225px; height: 315px;"><span>z-2</span></div>
                    </div>
                </div>
            </div>

        </form>
    </section>

</div>
@endsection

@push('script')
@endpush
