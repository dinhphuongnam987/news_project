@php
    $youtube = $item['youtube'];
    $facebook = $item['facebook'];
@endphp

<div class="col-md-3 social">
    <span class="title">Social</span>
    <div class="item">
        <i class="fa fa-facebook icon" aria-hidden="true"></i>
        <span>{{ $facebook }}</span>
    </div>
    <div class="item">
        <i class="fa fa-youtube icon" aria-hidden="true"></i>
        <span>{{ $youtube }}</span>
    </div>
</div>