<!DOCTYPE html>
<html>
    <head>
        @include('includes.head')
    </head>
    <body>
        @if(Session::has('flash'))
            @include('includes.flashMessage', ['message' => Session::get('flash.message'), 'type' => Session::get('flash.type')])
        @endif
        @include('includes.header')
        @yield('content')
        @include('includes.footer')
        @include('includes.scripts')
    </body>
</html>
