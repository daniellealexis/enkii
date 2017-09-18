@extends('layouts/default')

@section('content')
<div>
    <section class="list">
        <h1 class="list__title">{{ $list['title'] }}</h1>
        <p class="list__description">{{ $list['description'] }}</p>
        @if (!empty($userCanEdit))
            <a href="{{ route('lists.edit', ['id' => $list['id']]) }}">
                <button class="btn--primary btn--fixed-bottom">Edit</button>
            </a>
        @endif
        <ol class="list__list-items">
            @if (!empty($list['list_items']))
                @foreach ($list['list_items'] as $listItem)
                    <li class="list-item" list-id="{{ $listItem->id }}">
                        <h3 class="list-item__title">{{ $listItem->title }}</h3>
                        <p class="list-item__description">{{ $listItem->description }}</p>
                    </li>
                @endforeach
            @endif
        </ol>
    </section>
</div>
@stop
