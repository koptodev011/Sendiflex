@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shiv Suman</title>
    <link rel="shortcut icon" href="assets/media/logos/companyLogo.webp" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
body {
    background-color: #f8f9fa;
    font-family: 'Nunito', sans-serif;
}

.login-container {
    max-width: 550px;
    margin: 0 auto;
    margin-top: 100px;
    padding: 30px;
    background: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 50px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.login-container h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.form-control {
    height: 50px;
    font-size: 16px;
    border-radius: 15px;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    height: 50px;
    font-size: 18px;
    border-radius: 10px;
}

.btn-primary:hover {
    background-color: #0069d9;
    border-color: #0062cc;
}

.form-check-label {
    font-size: 14px;
}

.text-danger {
    font-size: 14px;
}
</style>

<body>

    @section('content')
    <div class="container">
        <div class="login-container">
            <h2>{{ __('SpendiFix') }}</h2>

            <form method="POST" action="{{ route('login') }}" novalidate onsubmit="return validateForm()">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                    <span id="password-error" class="text-danger"></span>
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Login') }}
                    </button>
                </div>

                <div class="text-center">
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    @endsection

</body>

</html>
