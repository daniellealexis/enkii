@extends('layouts.default')

@section('content')
<main class="error-page">
    <h1 class="error-page--code">{{ $code or $exception->getCode() }}</h1>
    <h2 class="error-page--message">{{ $message or $exception->getMessage() }}</h2>
    <? /* In future, make these show for dev only  */ ?>
        <p style="display:none;">{{ $exception->getFile() }} : {{ $exception->getLine() }}</p>
        <p style="display:none;">{{ $exception->getTraceAsString() }}</p>
    <? /* */ ?>
</main>
@endsection
