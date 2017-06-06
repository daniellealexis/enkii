@extends('components.formGroup._base', ['hasError' => $errors->has($name)])

@section('input')
    {{ Form::label($name, $label, ['class' => 'form__input-label']) }}

    @if ($name === 'email')
        {{ Form::email($name, $value, ['class' => 'textbox']) }}
    @else
        {{ Form::text($name, $value, ['class' => 'textbox']) }}
    @endif

    @if ($errors->has($name))
        <span class="form__error-text">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
@overwrite
