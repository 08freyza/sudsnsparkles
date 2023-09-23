@extends('layout.auth.main')

@section('content')
<div class="form-card px-lg-5 px-4 py-5 border border-2 rounded">
    <h1 class="fw-medium fs-36 text-navysky text-center mb-4">Registration</h1>

    <form action="{{ url('registration-action') }}" method="POST">
        @csrf

        <div class="mb-3">
            <input type="text" class="form-control px-4 py-3 @error('name') is-invalid @enderror" id="name" name="name" placeholder="Your name" value="{{ old('name') }}">
            @error('name')
                <div id=" validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <input type="text" class="form-control px-4 py-3 @error('username') is-invalid @enderror" id="username" name="username" placeholder="Your username" value="{{ old('username') }}">
            @error('username')
                <div id=" validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <input type="text" class="form-control px-4 py-3 @error('email') is-invalid @enderror" id="email" name="email" placeholder="Your email" value="{{ old('email') }}">
            @error('email')
                <div id=" validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <input type="password" class="form-control px-4 py-3 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
            @error('password')
                <div id=" validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <input type="password" class="form-control px-4 py-3 @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
            @error('password_confirmation')
                <div id=" validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100 py-3">Register</button>
        <p class="text-navysky fw-medium fs-16 m-0 mt-4 text-center">
            Have an account? <a href="{{ url('login') }}" class="text-decoration-none">Login here</a>
        </p>
    </form>
</div>
@endsection
