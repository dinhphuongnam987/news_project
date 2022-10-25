@extends('admin.main')
@section('content')
    <div class="page-header zvn-page-header clearfix">
        <div class="zvn-page-header-title">
            <h3>Quản Lý Gallery</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <iframe src="{{ url('laravel-filemanager') }}" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
            </div>
        </div>
    </div>
@endsection