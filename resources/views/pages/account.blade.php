@extends('layouts.default')

@section('content')
<main class="profile">
    <h1>{{ $name }}</h1>
    <h2>{{ $email }}</h2>
</main>
@endsection
