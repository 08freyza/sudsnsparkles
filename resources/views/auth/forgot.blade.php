@extends('layout.auth.main')

@section('content')
<div class="form-card px-lg-5 px-4 py-5 border border-2 rounded">
    <h1 class="fw-medium fs-36 text-navysky text-center mb-4">Forgot Password</h1>

    <form action="{{ url('forgot-action') }}" method="POST">
        @csrf

        <div class="mb-3">
            <input type="text" class="form-control px-4 py-3 @error('email') is-invalid @enderror" id="email" name="email" placeholder="Your email address" aria-describedby="emailHelp">
            @error('email')
                <div id=" validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 py-3">Send</button>
        <p class="text-navysky fw-medium fs-16 m-0 mt-4 text-center">
            Remember your password? <a href="{{ url('login') }}" class="text-decoration-none">Login here</a>
        </p>
    </form>
</div>
@endsection

