@extends('admin.main')
@section('content')
    @include ('admin.templates.page_header', ['pageIndex' => false])
    @include ('admin.templates.error')

    <div class="row">
        @include ('admin.pages.setting.tab')
        @include('admin.pages.setting.form_general_setting')
    </div>
@endsection
