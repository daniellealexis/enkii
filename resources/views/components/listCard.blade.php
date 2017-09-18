<a class="list-card" href="{{ route('lists.show', ['id' => $list['id']]) }}">
    <h4 class="list-card__title">{{ $list['title'] }}</h4>
    <p class="list-card__description">{{ $list['description'] }}</p>
</a>
