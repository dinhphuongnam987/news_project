@extends('admin.main')
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');

    $elements = [
        [
            'label'   => Form::label('email', 'Email Admin', $formLabelAttr),
            'element' => Form::text('email', @$item['email'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('password', 'Password', $formLabelAttr),
            'element' => Form::text('password', @$item['password'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('email_bcc', 'Email BCC', $formLabelAttr),
            'element' => Form::text('email_bcc', @$item['email_bcc'],  $formInputAttr )
        ],
        [
            'element' => Form::submit('Save', ['name' => 'btn-email-setting', 'class'=>'btn btn-success']),
            'type'    => "btn-submit"
        ]
    ];
@endphp

@section('content')
    @include ('admin.templates.page_header', ['pageIndex' => false])
    @include ('admin.templates.error')

    <div class="row">
        @include ('admin.pages.setting.tab', ['controllerName' => $controllerName])
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
    </div>
@endsection
