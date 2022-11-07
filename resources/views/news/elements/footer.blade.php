@php
    use App\Models\SettingModel;
    
    $model = new SettingModel();
    $itemGeneral = $model->getItem(['field' => 'key_value', 'field_value' => 'general-setting'], ['task' => 'get-item']);
    $itemSocial = $model->getItem(['field' => 'key_value', 'field_value' => 'social-setting'], ['task' => 'get-item']);
@endphp

<footer class="footer">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                @include('news.elements.footer.general', ['item' => $itemGeneral])
                @include('news.elements.footer.social', ['item' => $itemSocial])
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
    @include('news.elements.footer.copyright', ['copyright' => $itemGeneral['copyright']])
</footer>
