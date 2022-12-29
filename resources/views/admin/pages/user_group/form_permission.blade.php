@php
    $currentPermissions = !empty($item['permission_ids']) ? array_flip(json_decode($item['permission_ids'])) : null;
@endphp

<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.templates.x_title', ['title' => 'Form Permissions'])
        <div class="x_content">
            {{ Form::open([
                'method' => 'POST',
                'url' => route("$controllerName/save"),
                'accept-charset' => 'UTF-8',
                'enctype' => 'multipart/form-data',
                'class' => 'form-horizontal form-label-left',
                'id' => 'main-form',
            ]) }}
            @foreach($permissions as $val)
                @php
                    if($currentPermissions) {
                        $classChecked = array_key_exists($val->id, $currentPermissions) ?? true;
                    }
                @endphp
                <div class="form-check">
                    {{ Form::checkbox('permission_ids[]', $val->id, $classChecked ?? ''); }}
                    {{ Form::label('', $val->description) }}
                    {{ Form::hidden('id', $item['id'] ?? '') }}
                </div>
            @endforeach
            {{ Form::submit('Save', ['class' => 'btn btn-success', 'name' => 'btn-permission']) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
