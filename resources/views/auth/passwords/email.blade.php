<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('head')

<body>


    <style>
        .email-reset-link-container {
            max-width: 400px;
            margin: 100px auto 0 auto;
            text-align: center;
        }

        .login-label {
            color: #3b6b9b;
            margin-bottom: 0 !important;
        }
    </style>
    <div class="email-reset-link-container">
        <p class="is-size-5 has-text-weight-bold">{{ __('Reset Password') }}</p>

        <div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class="label login-label has-text-left">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="button is-small is-primary" style="margin-top:10px;">
                    {{ __('Send Password Reset Link') }}
                </button>

            </form>
        </div>
    </div>

</body>

</html>