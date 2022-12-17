@extends('news.main')
@section('content')
<div class="section-category">
    @include('news.block.breadcrumb', ['item' => ['name' => $title]])
    <div class="content_container container_category">
        <div class="featured_title">
            <div class="container">
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-md-12">
                        <div class="check_out">
                            @include('news.pages.product.cart.checkout.detail')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection