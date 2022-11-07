@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');
  
    $inputHiddenThumb = Form::hidden('thumb_current', @$item['thumb']);

    $elements = [
        [
            'label'   => Form::label('thumb', 'Logo', $formLabelAttr),
            'element' => Form::file('thumb', $formInputAttr ),
            'thumb'   => (!empty(@$item['thumb'])) ? Template::showItemThumb($controllerName, @$item['thumb'], @$item['thumb']) : null ,
            'type'    => "thumb"
        ],
        [
            'label'   => Form::label('hotline', 'Hot Line', $formLabelAttr),
            'element' => Form::text('hotline', @$item['hotline'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('email', 'Email', $formLabelAttr),
            'element' => Form::text('email', @$item['email'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('address', 'Address', $formLabelAttr),
            'element' => Form::text('address', @$item['address'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('start_time', 'Start Time', $formLabelAttr),
            'element' => Form::time('start_time', @$item['start_time'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('end_time', 'End Time', $formLabelAttr),
            'element' => Form::time('end_time', @$item['end_time'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('copyright', 'Copyright', $formLabelAttr),
            'element' => Form::text('copyright', @$item['copyright'],  $formInputAttr )
        ],
        [
            'element' => $inputHiddenThumb . Form::submit('Save', ['name' => 'btn-general-setting', 'class'=>'btn btn-success']),
            'type'    => "btn-submit"
        ]
    ];
@endphp

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.templates.x_title', ['title' => 'Form'])
        @include('admin.templates.zvn_notify')
        <div class="x_content">
            {{ Form::open([
                'method'         => 'POST', 
                'url'            => route("$controllerName/save"),
                'accept-charset' => 'UTF-8',
                'enctype'        => 'multipart/form-data',
                'class'          => 'form-horizontal form-label-left',
                'id'             => 'main-form' ])  }}
                {!! FormTemplate::show($elements)  !!}
            {{ Form::close() }}
        </div>
    </div>
</div>