@extends('news.main')
@section('content')
<div class="section-category">
    @include('news.block.breadcrumb', ['item' => ['name' => $title]])
    <div class="content_container container_category">
        <div class="featured_title">
            <div class="container">
                <div class="row">
                    @if($gallery)
                        @foreach($gallery as $item)
                            <div class="col-md-3 mb-4"><img src="{{ url('images/'. $item) }}" width="100%"></div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection