@extends('components.formGroup._base')

@section('input')
    {{ Form::submit($text, ['class' => 'btn--primary']) }}
@overwrite
