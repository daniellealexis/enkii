@extends('layouts.default')

@section('content')
<main class="account horizontal-center">
    <section class="form form--thin">
    <h1 class="form__header">{{ $name }}</h1>
    <div class="form__group">
        <label class="form__input-label">Email</label>
        <input class="textbox" name="email" value="{{ $email }}"></input>
    </div>
    <div class="form__group">
        <label class="form__input-label">Job Title</label>
        <input class="textbox" name="job title" value="{{ $jobTitle }}"></input>
    </div>
    <div class="form__group">
        <label class="form__input-label">Twitter</label>
        <input class="textbox" name="twitter handle" value="{{ $twitterHandle }}"></input>
    </div>
</main>
@endsection
