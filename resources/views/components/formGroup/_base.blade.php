{{-- Function signature:
    'name',
    'label',
    'value',
    'attributes',
 --}}

<div class="form__group{{ !empty($hasError) ? ' form__group--has-error' : '' }}">
    @yield('input')
</div>
