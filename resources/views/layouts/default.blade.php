<!DOCTYPE html>
<html>
    <head>
        @include('includes.head')
    </head>
    <body>
        @if(Session::has('message'))
            @include('includes.flashMessage', ['message' => Session::get('message')])
        @endif
        @include('includes.header')
        @yield('content')
        @include('includes.footer')
        @include('includes.scripts')
    </body>
</html>
