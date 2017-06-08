<!DOCTYPE html>
<html>
    <head>
        @include('includes.head')
    </head>
    <body>
        @if(Session::has('flashMessage'))
            @include('includes.flashMessage', ['message' => Session::get('flashMessage')])
        @endif
        @include('includes.header')
        @yield('content')
        @include('includes.footer')
        @include('includes.scripts')
    </body>
</html>
