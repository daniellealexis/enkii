@extends('layouts.default')

@section('content')
<h4>{{ $message or '' }}</h4>
<!--
    To-do: Make custom components for the groups
    https://laravelcollective.com/docs/master/html#custom-components
-->
<main class="account horizontal-center">
    <section class="form form--thin">
        {{ Form::model(Auth::user(), ['url' => 'api/account']) }}
            <h1 class="form__header">{{ $name }}</h1>
            {{ Form::text('name', null, ['class' => 'textbox']) }}

            <div class="form__group">
                <label class="form__input-label">Email</label>
                {{ Form::email('email', null, ['class' => 'textbox']) }}
            </div>
            <div class="form__group">
                <label class="form__input-label">Job Title</label>
                {{ Form::text('job_title', null, ['class' => 'textbox']) }}
            </div>
            <div class="form__group">
                <label class="form__input-label">Twitter</label>
                {{ Form::text('twitter_handle', null, ['class' => 'textbox']) }}
            </div>
            <div class="form__group">
                {{ Form::submit('Update Account', ['class' => 'btn--primary']) }}
            </div>
        {{ Form::close() }}
    </section>
</main>


@endsection
