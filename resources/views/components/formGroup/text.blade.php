@extends('components.formGroup._base')

@section('input')
    {{ Form::label($name, $label, ['class' => 'form__input-label']) }}

    @if ($name === 'email')
        {{ Form::email($name, $value, ['class' => 'textbox']) }}
    @else
        {{ Form::text($name, $value, ['class' => 'textbox']) }}
    @endif
@overwrite
