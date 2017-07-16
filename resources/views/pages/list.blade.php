@extends('layouts/default')

@section('content')
<div>
    <section class="list">
        <h1 class="list__title">{{ $title }}</h1>
        <p class="list__description">{{ $description }}</p>
        <ol class="list__list-items">
            @if (isset($listItems))
                @foreach ($list_items as $listItem)
                    <li class="list-item">
                        <h3 class="list-item__title">{{ $listItem->title }}</h3>
                        <p>Id: {{ $listItem->id }}</p>
                        <p class="list-item__description">{{ $listItem->description }}</p>
                    </li>
                @endforeach
            @endif
        </ol>
    </section>
</div>
@stop
