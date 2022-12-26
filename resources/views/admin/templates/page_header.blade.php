@php
    $pageTitle = 'Quản lý ' . ucfirst($controllerName); 
    $pageButton= sprintf('<a href="%s" class="btn btn-success"><i class="fa fa-arrow-left"></i> Quay về</a>', route('dashboard'));
    if($pageIndex == true) {
        $pageButton= sprintf('<a href="%s" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>', route($controllerName . '/form'));
    }

    $pageImport = isset($pageImport) ? $pageImport : null;
    $urlImport = isset($urlImport) ? $urlImport : null;

@endphp


<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>{{  $pageTitle }}</h3>
    </div>
    <div class="zvn-add-new pull-right">
        {!! $pageButton !!}
    </div>
    <div class="zvn-add-new pull-right">
        @if ($pageImport)
            <form action="{{ $urlImport }}" method="POST" enctype="multipart/form-data" style="display: flex">
                @csrf
                <input id="import" type="file" name="excel_file" accept=".xlsx, .xls, .csv" required>
                <button type="submit" class="btn btn-info">Nhập file excel</button>
            </form>
        @endif
    </div>
</div>