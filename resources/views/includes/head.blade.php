<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>{{ $title or config('app.name', 'Enkii') }}</title>

<link href="{{ asset('css/app-main.css') }}" rel="stylesheet" type="text/css">
@stack('styles')
