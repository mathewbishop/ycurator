<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('head')

<body>

    <style>
        .register-container {
            max-width: 400px;
            margin: 100px auto 0 auto;
            text-align: center;
        }

        .login-label {
            color: #3b6b9b;
            margin-bottom: 0 !important;
        }
    </style>

    <div class="register-container">
        <p class="is-size-5 has-text-weight-bold">{{ __('Register') }}</p>

        <div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div style="margin-top:5px;">
                    <label for="name" class="label login-label has-text-left">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="input auth-input @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div style="margin-top:5px;">
                    <label for="email" class="label login-label has-text-left">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="input auth-input @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div style="margin-top:5px;">
                    <label for="password" class="label login-label has-text-left">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password"
                            class="input auth-input @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div style="margin-top:5px;">
                    <label for="password-confirm"
                        class="label login-label has-text-left">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="input auth-input"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div style="margin-top:5px;">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="button is-small is-primary" style="margin-top:10px;">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>