@extends('news.main')
@section('content')
<div class="section-category">
    @include('news.block.breadcrumb', ['item' => ['name' => $title]])
    <div class="content_container container_category">
        <div class="container">
            @include('news.pages.contact.info', ['item' => $item])
            @include('news.pages.contact.form', ['item' => $item])
        </div>
    </div>
</div>
@endsection