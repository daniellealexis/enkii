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
        <h2 class="list-card__container__headline">Your Lists</h2>
        @if (!empty($lists))
            <div class="list-card__container">
                @foreach ($lists as $list)
                    @include('components.listCard', ['list' => $list])
                @endforeach
            </div>
        @else
            <p>You currently don't have any lists yet.</p>
        @endif
        </div>
    </div>
</main>
@include('components.createListButton')
@endsection
