<!DOCTYPE html>
<html>
    <head>
        @include('includes.head')
    </head>
    <body>
        @include('includes.header')
        @yield('content')
        @include('includes.footer')
        @include('includes.scripts')
    </body>
</html>
