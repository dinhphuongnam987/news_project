@extends('news.main')
@section('content')

    @include ('news.block.slider')
    <!-- Content Container -->
    <div class="content_container">
        <div class="container">
            <div class="row">

                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="main_content">
                        <!-- Featured -->
                        @include('news.block.featured', ['items' => $itemsFeatured ] )
                        
                        <!-- CATEGORY -->
                        @include('news.pages.home.child-index.category') 
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-3">
                    <div class="sidebar">
                        <!-- Latest Posts -->
                        @include ('news.block.latest_posts', ['items' => $itemsLatest])

                        <!-- Advertisement -->
                        @include ('news.block.advertisement', ['itemsAdvertisement' => []])

                        <!-- MostViewed -->
                        @include ('news.block.most_viewed', ['itemsMostViewed' => []])

                        <!-- Tags -->
                        @include ('news.block.tags', ['itemsTags' => []])
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection