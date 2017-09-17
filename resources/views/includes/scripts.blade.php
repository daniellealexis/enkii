<script src="{{ asset('js/app-main.js') }}"></script>

@if (session('flash'))
    <script>
        window.eridu = window.eridu || {};
        window.eridu.flash = {!! json_encode(session('flash')) !!};
    </script>
@endif

@stack('scripts')
