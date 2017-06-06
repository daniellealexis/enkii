@extends('layouts.default')

@section('content')
<h4>{{ $message or '' }}</h4>
<main class="account horizontal-center">
    <section class="form form--thin">
        {{ Form::model(Auth::user(), ['url' => '/account/update']) }}
            <h1 class="form__header">{{ $name }}</h1>
            {{ Form::formGroup_text('name', 'Name') }}
            {{ Form::formGroup_text('email', 'Email') }}
            {{ Form::formGroup_text('job_title', 'Job Title') }}
            {{ Form::formGroup_text('twitter_handle', 'Twitter') }}
            {{ Form::formGroup_submit('Update Account') }}
        {{ Form::close() }}
    </section>
</main>


@endsection
