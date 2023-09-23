@extends('layout.auth.main')

@section('content')
<div class="form-card px-lg-5 px-4 py-5 border border-2 rounded">
    <h1 class="fw-medium fs-36 text-navysky text-center mb-4">Reset Password</h1>

    <form action="{{ url('reset-password-action') }}" method="POST">
        @csrf

        <input type="hidden" name="email" value="{{ $email }}">
        <div class="mb-3">
            <input type="password" class="form-control px-4 py-3 @error('password') is-invalid @enderror" id="password" name="password" placeholder="New password">
            @error('password')
                <div id=" validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <input type="password" class="form-control px-4 py-3 @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
            @error('password_confirmation')
                <div id=" validationServer03Feedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 py-3">Change Password</button>
    </form>
</div>
@endsection

