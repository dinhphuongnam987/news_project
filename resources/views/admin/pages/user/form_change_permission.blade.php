@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template;

$formInputAttr = config('zvn.template.form_input');
$formLabelAttr = config('zvn.template.form_label_edit');

$levelValue = ['default' => 'Select value', 
                'founder' => config('zvn.template.level.founder.name'),
                'admin' => config('zvn.template.level.admin.name'), 
                'member' => config('zvn.template.level.member.name')];

$permissionValue['default']  = 'Select permission';
foreach ($groupUserItems as $val) {
    $permissionValue[$val['id']] = $val['name'];
}

$inputHiddenID = Form::hidden('id', @$item['id']);

$elements = [
    [
        'label'   => Form::label('permission', 'Permission', $formLabelAttr),
        'element' => Form::select('permission', $permissionValue, $item['group_id'] ?? '', $formInputAttr)
    ],
    [
        'element' => $inputHiddenID .Form::submit('Save', ['class' => 'btn btn-success', 'name' => 'btn-change-permission']),
        'type' => 'btn-submit-edit',
    ],
];

@endphp

<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.templates.x_title', ['title' => 'Phân quyền'])
        <div class="x_content">
            {{ Form::open([
                'method' => 'POST',
                'url' => route("$controllerName/change-permission"),
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
