@php
    $hotline = $item['hotline'];
    $address = $item['address'];
    $email = $item['email'];
    $startTime = $item['start_time'];
    $endTime = $item['end_time'];
    $logo = asset('images/setting/' . $item['thumb']);
    $copyright = $item['copyright'];
@endphp

<div class="col-md-5 general">
    <img src="{{ $logo }}" alt="{{ $logo }}" class="logo">
    <div class="item">
        <i class="fa fa-map-marker icon" aria-hidden="true"></i>
        <span>{{ $address }}</span>
    </div>
    <div class="item">
        <i class="fa fa-clock-o icon" aria-hidden="true"></i>
        <span>{{ "$startTime - $endTime" }}</span>
    </div>
    <div class="item">
        <i class="fa fa-phone icon" aria-hidden="true"></i>
        <span>{{ $hotline }}</span>
    </div>
    <div class="item">
        <i class="fa fa-envelope-o icon" aria-hidden="true"></i>
        <span>{{ $email }}</span>
    </div>
</div>