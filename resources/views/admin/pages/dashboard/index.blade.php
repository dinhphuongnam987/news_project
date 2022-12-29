@php
    $elements = [
        [
            'count' => $items['countUser'],
            'title' => 'Tổng số người dùng',
            'link'  => route('user'),
            'icon' => 'fa fa-user'
        ],
        [
            'count' => $items['countCategory'],
            'title' => 'Tổng số danh mục bài viết',
            'link'  => route('category'),
            'icon' => 'fa fa-table'
        ],
        [
            'count' => $items['countArticle'],
            'title' => 'Tổng số bài viết',
            'link'  => route('article'),
            'icon' => 'fa fa-newspaper-o'
        ],
        [
            'count' => $items['countSlider'],
            'title' => 'Tổng số slider',
            'link'  => route('slider'),
            'icon' => 'fa fa-sliders'
        ]

    ];
@endphp

@extends('admin.main')
@section('content')
    @include ('admin.templates.zvn_notify')
    <div class="page-header zvn-page-header clearfix">
        <div class="zvn-page-header-title">
            <h3>Quản Lý Thống Kê</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.pages.dashboard.list', ['items' => $elements])
            </div>
        </div>
    </div>
@endsection