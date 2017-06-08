@extends('components.formGroup._base', ['hasError' => $errors->has($name)])

@section('input')
    <div class="checkbox">
        <label>
            <input type="checkbox" name="{{ $name }}" {{ $isChecked ? 'checked' : '' }}>
            <span class="checkbox__label-text">{{ $label }}</span>
        </label>
    </div>
@overwrite
