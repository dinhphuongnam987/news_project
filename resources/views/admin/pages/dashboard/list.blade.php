<div class="row" style="display: flex; justify-content: space-around">
    @if(isset($items))
        @foreach($items as $item)
            @php
                $count = $item['count'];
                $title = $item['title'];
                $link = $item['link'];
                $icon = $item['icon'];
                // dd($icon);
            @endphp

            <div class="col-md-3" style="border: 2px solid lightblue; margin: 5px">
                <div class="row">
                    <div class="col-md-9">
                        <div class="dashboard-box_left">
                            <h1>{{ $count }}</h1>
                            <h4>{{ $title }}</h4>
                            <a href={{ $link }}>Xem chi tiết</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-box_right" style="margin-top: 10px">
                            <i class="{{ $icon }}" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>