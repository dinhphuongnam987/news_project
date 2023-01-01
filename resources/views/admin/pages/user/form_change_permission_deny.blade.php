@php
    $currentPermissions = !empty($item['permission_deny']) ? array_flip(json_decode($item['permission_deny'])) : null;
@endphp

<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.templates.x_title', ['title' => 'Hạn chế quyền'])
        <div class="x_content">
            {{ Form::open([
                'method' => 'POST',
                'url' => route("$controllerName/change-permission-deny"),
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
                        {{ Form::checkbox('permission_deny[]', $val->id, $classChecked ?? ''); }}
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
