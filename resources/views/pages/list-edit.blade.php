@extends('layouts/blank-default')

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/listEditor.js') }}"></script>
@endpush

@section('content')
<main>
    {{-- <section class="list-edit-form form"> --}}
        {{-- {{ dd(get_defined_vars()) }} --}}
{{--         {{ Form::open(['url' => '/lists/'.$id]) }}
            {{ Form::hidden('_method', 'PUT') }}
            {{ Form::formGroup_text('title', 'List Title', $title) }}
            {{ Form::formGroup_textarea('description', 'Description', $description) }}
            @if (isset($list_items) && !empty($list_items))
                <div class="list-items">
                <h2 class="list-items__section-title">List Items</h2>
                @foreach ($list_items as $listItem)
                    <div class="list-item">
                        {{ Form::hidden("list_items[$loop->index][id]", $listItem->id) }}
                        {{ Form::formGroup_text("list_items[$loop->index][title]", 'List Item Title', $listItem->title) }}
                        {{ Form::formGroup_textarea("list_items[$loop->index][description]", 'Description', $listItem->description) }}
                    </div>
                @endforeach
                </div>
            @endif
            {{ Form::formGroup_submit('Save List') }}
        {{ Form::close() }} --}}
        {{-- React App Root --}}
        <div id="root"></div>
    {{-- </section> --}}

</main>
@stop
