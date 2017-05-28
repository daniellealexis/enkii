@extends('layouts.default')

@section('content')
<main class="horizontal-center">
    <section class="form form--thin">
        <h1 class="form__header">Sign-up!</h1>
        <form role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form__group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="form__input-label">Name</label>
                <input id="name" type="text" class="textbox" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="form__help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="form__input-label">E-Mail Address</label>
                <input id="email" type="email" class="textbox" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="form__help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="form__input-label">Password</label>
                <input id="password" type="password" class="textbox" name="password" required>

                @if ($errors->has('password'))
                    <span class="form__help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form__group">
                <label for="password-confirm" class="form__input-label">Confirm Password</label>
                <input id="password-confirm" type="password" class="textbox" name="password_confirmation" required>
            </div>

            <div class="form__group">
                <button type="submit" class="btn--primary">
                    Register
                </button>
            </div>
        </form>
    </section>
</main>
@endsection
