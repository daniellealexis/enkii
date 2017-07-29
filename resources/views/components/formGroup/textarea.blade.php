@extends('components.formGroup._base', ['hasError' => $errors->has($name)])

@section('input')
    {{ Form::label($name, $label, ['class' => 'form__input-label']) }}

    {{ Form::textarea($name, $value, ['class' => 'textarea', 'size' => '50x5']) }}

    @if ($errors->has($name))
        <span class="form__error-text">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif

    {{-- Figure out a way to pass attributes like required and autofocus, while mantaining default classes --}}
@overwrite
