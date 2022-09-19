<div class="featured">
    <div class="featured_title">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title_container d-flex flex-row align-items-start justify-content-start">
                        <div>
                            <div class="section_title">Bài viết nổi bật</div>
                        </div>
                        <div class="section_bar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="post_item post_v_large d-flex flex-column align-items-start justify-content-start">
                @include('news.partials.article.image', ['item' => $items[0] ])
                @include('news.partials.article.content', ['item' => $items[0], 'lenghtContent' => 500, 'showCategory' => true ])
            </div>
        </div>
        <div class="col-lg-4">
            @php unset($items[0]) @endphp
            @foreach($items as $item)
                <!-- Post -->
                <div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
                    @include('news.partials.article.image', ['item' => $item ])
                    @include('news.partials.article.content', ['item' => $item, 'lenghtContent' => 0, 'showCategory' => true ])
                </div>
            @endforeach
        </div>
    </div>
</div>