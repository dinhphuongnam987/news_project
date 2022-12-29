@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;
    
    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');
    
    $inputHiddenID = Form::hidden('id', $item['id'] ?? '');
    
    $elements = [
        [
            'label' => Form::label('name', 'Name', $formLabelAttr),
            'element' => Form::text('name', $item['name'] ?? '', $formInputAttr),
        ],
    ];
@endphp


<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.templates.x_title', ['title' => 'Form Edit Info'])
        <div class="x_content">
            {{ Form::open([
                'method' => 'POST',
                'url' => route("$controllerName/save"),
                'accept-charset' => 'UTF-8',
                'enctype' => 'multipart/form-data',
                'class' => 'form-horizontal form-label-left',
                'id' => 'main-form',
            ]) }}
            {!! FormTemplate::show($elements) !!}
            <div class="form-group">
                <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Permission</label>
                <div class="col-md-6">
                    @foreach($permissions as $val)
                        <div class="form-group">
                            {{ Form::checkbox('permission_ids[]', $val->id) }}
                            {{ Form::label('', $val->description) }}
                        </div>
                    @endforeach
                    {{ Form::submit('Save', ['class' => 'btn btn-success']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
