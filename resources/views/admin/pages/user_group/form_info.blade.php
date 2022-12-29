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
        [
            'element' => $inputHiddenID . Form::submit('Save', ['class' => 'btn btn-success', 'name' => 'btn-info']),
            'type' => 'btn-submit',
        ],
    ];
@endphp


<div class="col-md-6 col-sm-12 col-xs-12">
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
            {{ Form::close() }}
        </div>
    </div>
</div>
