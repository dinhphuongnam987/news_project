@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');

    $token = Form::hidden('_token', csrf_token(), ['id' => 'token']);
    $urlThankYou = Form::hidden('url_thank_you', route("$controllerName/thank-you"), ['id' => 'url_thank_you']);
    $elements = [
        [
            'label'   => Form::label('name', 'Họ & Tên'),
            'element' => Form::text('name', '', ['class' => 'form-control'])
        ],
        [
            'label'   => Form::label('email', 'Email'),
            'element' => Form::text('email', '', ['class' => 'form-control'])
        ],
        [
            'label'   => Form::label('phone', 'Số điện thoại'),
            'element' => Form::text('phone', '', ['class' => 'form-control'])
        ],
        [
            'element' => $token. $urlThankYou. Form::submit('Đặt Hàng', ['id' => 'btn-order', 'class'=>'btn btn-success', 'data-url' => route("$controllerName/order")]),
        ]
    ];
@endphp
<div id="thank_you" style="display: none;">
    <p>Thanks for filling up the form!</p>
    <button type="submit">Close</button>
</div>
<div id="errors"></div>
@include ('admin.templates.error')
<h3>Thông tin</h3>
{{ Form::open([
    'method'         => 'POST', 
    'url'            => route("$controllerName/order"),
    'accept-charset' => 'UTF-8',
    'enctype'        => 'multipart/form-data',
    'class'          => 'form-horizontal form-label-left',
    'id'             => 'main-form' ])  }}
    {!! FormTemplate::showFormContact($elements) !!}
{{ Form::close() }}
