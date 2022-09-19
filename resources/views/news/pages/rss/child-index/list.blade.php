<div class="posts">
    <div class="col-lg-12">
        <div class="row">
            @foreach($items as $item)
                @php
                    $name = $item['title'];
                    $thumb = $item['thumb'];
                    $link = $item['link'];
                    $pubDate = $item['pubDate'];
                    $description = $item['description'];

                @endphp
                <div class="col-lg-6">
                    <div class="post_item post_v_med d-flex flex-column align-items-start justify-content-start">
                        <div class="post_image">
                            <img src="{{  $thumb  }}" alt="{{ $name }}">
                        </div>
                        <div class="post_content">
                            <div class="post_title"><a href="{{ $link }}">{{ $name }}</a></div>
                            <div class="post_info d-flex flex-row align-items-center justify-content-start">
                                <div class="post_date"><a href="#">{{ $pubDate }}</a></div>
                            </div>
                        
                            <div class="post_text">
                                <p>{{ $description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>