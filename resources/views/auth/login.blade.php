@extends('layouts.app')

@section('content')

<style>
    .login-form-container {
        max-width: 400px;
        margin: 0 auto;
        text-align: center;
    }
    .login-label {
        color: #3b6b9b;
        margin-bottom: 0 !important;
    }
</style>
<div class="login-form-container">

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div style="margin-top:10px;text-align:left;">
                <label for="email" class="label login-label">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div style="margin-top:10px;text-align:left;">
                <label for="password" class="label login-label">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div style="margin-top:5px;margin-bottom:10px;">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="label login-label is-inline" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="button is-small btn-login">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="is-block" href="{{ route('password.request') }}" style="margin-top:10px;">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <p class="is-inline">No account? </p><a class="nav-link" href="{{ route('register') }}" style="text-decoration:underline;">{{ __('Register') }}</a>
                    @endif
                </div>
            </div>
        </form>
</div>
@endsection
