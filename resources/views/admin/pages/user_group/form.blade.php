@extends('admin.main')

@section('content')
    @include ('admin.templates.page_header', ['pageIndex' => false])
    @include ('admin.templates.error')

    @if ( @$item['id'])
        @include('admin.pages.user_group.form_info')
        @include('admin.pages.user_group.form_permission')
    @else
        @include('admin.pages.user_group.form_add')
    @endif
@endsection