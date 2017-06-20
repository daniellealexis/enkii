@extends('layouts.default')

@section('content')
<main class="dashboard">
    <h1 class="visibility-none">Dashboard</h1>
    <div class="dashboard--user-data">
        <h2>{{ $user['name'] }}</h2>
        <h4>{{ $user['jobTitle'] }}</h4>
        <h4>{{ $user['twitterHandle'] }}</h4>
        <a href="{{ route('editAccount') }}">
            <button class="btn--primary">Edit Profile</button>
        </a>
    </div>
    <hr>
    <div class="dashboard--lists">
        <h2>Your Lists</h2>
    </div>
</main>
@endsection
