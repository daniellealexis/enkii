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

            <form role="form" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <div class="form__group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="form__input-label">E-Mail Address</label>
                    <input id="email" type="email" class="textbox" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="form__help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form__group">
                    <button type="submit" class="btn--primary">
                        Send Password Reset Link
                    </button>
                </div>
            </form>
    </section>
</main>
@endsection
