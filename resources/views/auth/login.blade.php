@extends('layouts.default')

@section('content')
<main class="horizontal-center">
    <section class="form form--thin">
        <h1 class="form__header">Login</h1>
        <form role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form__group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="form__input-label">E-Mail Address</label>

                <input id="email" type="email" class="textbox" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="form__help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="form__input-label">Password</label>

                <input id="password" type="password" class="form__textbox textbox" name="password" required>

                @if ($errors->has('password'))
                    <span class="form__help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
            </div>

            <div class="form__group">
                <button type="submit" class="btn--primary">
                    Login
                </button>

                <a class="btn--link" href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
            </div>
        </form>
    </section>
</main>
@endsection
