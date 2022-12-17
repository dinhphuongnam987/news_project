@extends('news.main')
@section('content')
<div class="section-category">
    @include('news.block.breadcrumb', ['item' => ['name' => $title]])
    <div class="content_container container_category">
        <div class="featured_title">
            <div class="container">
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-lg-9">
                        <div class="single_product">
                            @include('news.pages.product.child_index', ['items' => $itemsProduct])
                        </div>
                    </div>
                    <!-- Sidebar -->
                    <div class="col-lg-3">
                        <div class="sidebar">
                            <!-- Latest Posts -->
                            {{-- @include ('news.block.latest_posts', ['items' => $itemsLatest]) --}}
    
                            <!-- Advertisement -->
                            @include ('news.block.advertisement', ['itemsAdvertisement' => []])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection