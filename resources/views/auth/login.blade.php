@extends('layout.auth.main')

@section('content')
<div class="form-card px-lg-5 px-4 py-5 border border-2 rounded">
    <h1 class="fw-medium fs-36 text-navysky text-center mb-4">Login</h1>

    <form action="{{ url('login-action') }}" method="POST">
        @csrf

        <div class="mb-3">
            <input type="text" class="form-control px-4 py-3" id="username" name="username" placeholder="Enter your email or username" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <input type="password" class="form-control px-4 py-3" id="password" name="password" placeholder="Enter your password">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-3">Login</button>
        <p class="text-navysky fw-medium fs-16 m-0 mt-4 text-center">
            <span class="d-sm-inline d-none">Don't have an account? </span><span class="d-sm-none d-inline">Create an account? </span><a href="{{ url('registration') }}" class="text-decoration-none">Register here</a>
        </p>
        <p class="text-navysky fw-medium fs-16 m-0 mt-0 text-center">
            <a href="{{ url('forgot') }}" class="text-decoration-none">Forgot your password?</a>
        </p>
    </form>
</div>
@endsection

