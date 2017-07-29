@extends('layouts/default')

@section('content')
<main class="account horizontal-center">
    <section class="form form--thin">
        {{-- {{ dd(get_defined_vars()) }} --}}
        {{ Form::open(['url' => '/lists/'.$id]) }}
            {{ Form::hidden('_method', 'PUT') }}
            {{ Form::formGroup_text('title', 'List Title', $title) }}
            {{ Form::formGroup_text('description', 'Description', $description) }}
            {{ Form::formGroup_submit('Save List') }}
        {{ Form::close() }}
    </section>
</main>
@stop
