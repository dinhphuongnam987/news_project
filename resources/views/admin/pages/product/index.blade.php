@extends('admin.main')
@php
    use App\Helpers\Template as Template;
    use App\Models\CategoryModel;

    $xhtmlButtonFilter = Template::showButtonFilter($controllerName, $itemsStatusCount, $params['filter']['status'], $params['search'], $params['filter']['category']);
    $xhtmlAreaSeach    = Template::showAreaSearch($controllerName, $params['search']);
    $categoryModel  = new CategoryModel();
    $itemsCategory = $categoryModel->listItems(null, ['task' => 'admin-list-items-in-select-box-in-article']);
@endphp

@section('content')
    
    @include ('admin.templates.page_header', ['pageIndex' => true, 'pageImport' => true, 'urlImport' => route("$controllerName/import")])
    @include ('admin.templates.zvn_notify')
    @include ('admin.templates.error')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Bộ lọc'])
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-6">{!! $xhtmlButtonFilter !!}</div>
                        <div class="col-md-6">{!! $xhtmlAreaSeach !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Danh sách'])
                @include('admin.pages.product.list', ['itemsCategory' => $itemsCategory])
            </div>
        </div>
    </div>
    
    @if (count($items) > 0)
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    @include('admin.templates.x_title', ['title' => 'Phân trang'])
                    @include('admin.templates.pagination')
                </div>
            </div>
        </div>
    @endif
@endsection
