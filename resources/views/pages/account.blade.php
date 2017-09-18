@extends('layouts.default')

@section('content')
<main class="account horizontal-center">
    <section class="form form--thin">
        {{ Form::model($user, ['url' => '/account/update']) }}
            <h1 class="form__header">{{ $user->name }}</h1>
            <h2>{{ $user->email }}</h2>
            {{ Form::formGroup_text('name', 'Name') }}
            {{ Form::formGroup_text('job_title', 'Job Title') }}
            {{ Form::formGroup_text('twitter_handle', 'Twitter') }}
            {{ Form::formGroup_submit('Update Account') }}
        {{ Form::close() }}
    </section>
</main>
@endsection
