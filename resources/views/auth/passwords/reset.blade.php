@extends('layouts.default')

@section('content')
<main class="horizontal-center">
    <section class="form form--thin">
        <h1 class="form__header">Reset Password</h1>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form role="form" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form__group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="form__input-label">E-Mail Address</label>
                    <input id="email" type="email" class="textbox" name="email" value="{{ $email or old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form__group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="form__input-label">Password</label>
                    <input id="password" type="password" class="textbox" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form__group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="form__input-label">Confirm Password</label>
                     <input id="password-confirm" type="password" class="textbox" name="password_confirmation" required>

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form__group">
                    <button type="submit" class="btn--primary">
                        Reset Password
                    </button>
                </div>
            </form>
    </section>
</main>
@endsection
