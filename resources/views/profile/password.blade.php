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

        <form action="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/profile/change-password-process') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-12">
                    <div class="my-2 pb-1">
                        <label for="old_password" class="fw-medium fs-17">Old Password</label>
                        <input type="password" class="form-control px-3 py-2 @error('old_password') is-invalid @enderror" id="old_password" name="old_password" placeholder="Old password">
                        @error('old_password')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="my-2 pb-1">
                        <label for="password" class="fw-medium fs-17">New Password</label>
                        <input type="password" class="form-control px-3 py-2 @error('password') is-invalid @enderror" id="password" name="password" placeholder="New password">
                        @error('password')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="my-2 pb-1">
                        <label for="password_confirmation" class="fw-medium fs-17">Confirm New Password</label>
                        <input type="password" class="form-control px-3 py-2 @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                        @error('password_confirmation')
                            <div id=" validationServer03Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="my-2 pb-1 d-md-block d-none">
                        <div class="change-data d-flex justify-content-end">
                            <a class="btn btn-outline-danger w-25 py-2 mt-4 me-2 mb-1" href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/profile') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary w-25 py-2 mt-4 ms-2 my-1">Update Password</button>
                        </div>
                    </div>
                    <div class="my-2 pb-0 d-md-none d-block">
                        <div class="change-data d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary w-100 py-2 mt-4">Update Password</button>
                        </div>
                    </div>
                    <div class="mt-0 mb-2 pb-1 d-md-none d-block">
                        <div class="change-data d-flex justify-content-end">
                            <a class="btn btn-outline-danger w-100 py-2 mt-0 mb-1" href="{{ url((Auth::guard('admin')->check() == true ? 'admin' : '') . '/profile') }}">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

</div>
@endsection

@push('script')
@endpush
