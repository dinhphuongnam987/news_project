@foreach($itemsCategory as $item)
    @if($item['display'] == 'list')
        @include('news.pages.home.child-index.category_list')
    @elseif($item['display'] == 'grid')
        @include('news.pages.home.child-index.category_grid')
    @endif
@endforeach


