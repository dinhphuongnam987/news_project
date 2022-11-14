@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr = config('zvn.template.form_input');
    $formLabelAttr = config('zvn.template.form_label');

    $token = Form::hidden('_token', csrf_token(), ['id' => 'token']);
    $elements = [
        [
            'label'   => Form::label('name', 'Họ Tên'),
            'element' => Form::text('name', '', ['class' => 'form-control'])
        ],
        [
            'label'   => Form::label('email', 'Email'),
            'element' => Form::text('email', '', ['class' => 'form-control'])
        ],
        [
            'label'   => Form::label('phone', 'Phone'),
            'element' => Form::text('phone', '', ['class' => 'form-control'])
        ],
        [
            'label'   => Form::label('message', 'Lời nhắn'),
            'element' => Form::textarea('message', '', ['class' => 'form-control'])
        ],
        [
            'element' => $token. Form::submit('Save', ['id' => 'btn-contact', 'class'=>'btn btn-success', 'data-url' => route("$controllerName/save")]),
        ]
    ];

    FormTemplate::showFormContact($elements);
@endphp


<div class="row">
    <div class="contact-form col-12">
        <div class="row justify-content-between">
            <div class="map col-md-6">
                {!! $item['map'] !!}
            </div>
            <div class="form col-md-5">
                <p>Gửi tin nhắn cho chúng tôi</p> 
                <p>Bạn chỉ đầy đủ thông tin cá nhân và vấn đề trao đổi với ZendVN vào form bên dưới, sau khi nhận được thông tin này chúng tôi sẽ liên hệ với các bạn trong thời gian sớm nhất.</p>
                <div id="errors"></div>
                @include ('admin.templates.error')
                {{ Form::open([
                    'method'         => 'POST', 
                    'url'            => route("$controllerName/save"),
                    'accept-charset' => 'UTF-8',
                    'enctype'        => 'multipart/form-data',
                    'class'          => 'form-horizontal form-label-left',
                    'id'             => 'main-form' ])  }}
                    {!! FormTemplate::showFormContact($elements) !!}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>