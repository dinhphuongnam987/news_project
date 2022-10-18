@extends('admin.main')
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');

    $elements = [
        [
            'label'   => Form::label('current_password', 'Current Password', $formLabelAttr),
            'element' => Form::password('current_password', $formInputAttr )
        ],
        [
            'label'   => Form::label('password', 'New Password', $formLabelAttr),
            'element' => Form::password('password', $formInputAttr )
        ],
        [
            'label'   => Form::label('password_confirmation', 'Password Confirmation ', $formLabelAttr),
            'element' => Form::password('password_confirmation', $formInputAttr),
        ],
        [
            'element' => Form::submit('Save', ['class'=>'btn btn-success']),
            'type'    => "btn-submit"
        ]
    ];
@endphp

@section('content')
    @include ('admin.templates.page_header', ['pageIndex' => false])
    @include ('admin.templates.error')
    @include ('admin.templates.zvn_notify')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Form'])
                <div class="x_content">
                    {{ Form::open([
                        'method'         => 'POST', 
                        'url'            => route("$controllerName/change-password"),
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
