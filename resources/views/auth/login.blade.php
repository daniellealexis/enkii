@extends('layouts.default')

@section('content')
<main class="horizontal-center">
    <section class="form form--thin">
        <h1 class="form__header">Login</h1>
        <form role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            {{ Form::formGroup_text('email', 'Email', old('email')) }}
            {{-- need to add 'required' and 'autofocus' attrs --}}

            {{ Form::formGroup_text('password', 'Password') }}
            {{-- need to add 'required' attr --}}

            {{ Form::formGroup_checkbox('remember', 'Remember Me', old('remember')) }}

            {{ Form::formGroup_submit('Login') }}

            <a class="btn--link" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
        </form>
    </section>
</main>
@endsection
