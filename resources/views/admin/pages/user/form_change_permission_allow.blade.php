@php
    $currentPermissions = !empty($item['permission_allow']) ? array_flip(json_decode($item['permission_allow'])) : null;
@endphp

<div class="col-md-6 col-sm-12 col-xs-12"></div>
<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.templates.x_title', ['title' => 'Cho phép thêm quyền'])
        <div class="x_content">
            {{ Form::open([
                'method' => 'POST',
                'url' => route("$controllerName/change-permission-allow"),
                'accept-charset' => 'UTF-8',
                'enctype' => 'multipart/form-data',
                'class' => 'form-horizontal form-label-left',
                'id' => 'main-form',
            ]) }}
            <div class="col-md-4"></div>
            <div class="col-md-8">
                @foreach($permissions as $val)
                    @php
                        if($currentPermissions) {
                            $classChecked = array_key_exists($val->id, $currentPermissions) ?? true;
                        }
                    @endphp
                    <div class="form-check">
                        {{ Form::checkbox('permission_allow[]', $val->id, $classChecked ?? ''); }}
                        {{ Form::label('', $val->description) }}
                        {{ Form::hidden('id', $item['id'] ?? '') }}
                    </div>
                @endforeach
                {{ Form::submit('Save', ['class' => 'btn btn-success']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
