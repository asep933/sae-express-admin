@extends('layouts.auth')

@section('title', 'Sign In')

@section('main')
<p class="login-box-msg">{{ __('Sign in to start your session') }}</p>

<form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email"
            value="{{ old('email') }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
        @error('email')
        <span class="error invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>
    <div class="input-group mb-3">
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></span>
            </div>
            @push('scripts')
            <script>
                document
                    .getElementById("togglePassword")
                    .addEventListener("click", function() {
                        const passwordInput = document.getElementById("password");
                        const icon = this;

                        if (passwordInput.type === "password") {
                            passwordInput.type = "text";
                            icon.classList.remove("fa-eye");
                            icon.classList.add("fa-eye-slash");
                        } else {
                            passwordInput.type = "password";
                            icon.classList.remove("fa-eye-slash");
                            icon.classList.add("fa-eye");
                        }
                    });
            </script>
            @endpush
        </div>
        @error('password')
        <span class="error invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>
    <div class="row">
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
    </div>
    <p class="my-1">
        <a href="{{ route('password.request') }}">I forgot my password</a>
    </p>
</form>
@endsection