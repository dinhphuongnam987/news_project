<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 30px">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="{{ route($controllerName) }}"  class="tab">
                <button type="button" class="button-tab btn btn-primary">
                    Cấu hình chung
                </button>
            </a>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="{{ route($controllerName, ['key' => 'email-setting']) }}" class="tab">
                <button type="button" class="btn btn-success">
                    Cấu hình email
                </button>
            </a>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="{{ route($controllerName, ['key' => 'social-setting']) }}" class="tab">
                <button type="button" class="btn btn-danger">
                    Cấu hình social
                </button>
            </a>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="{{ route($controllerName, ['key' => 'bank-setting']) }}" class="tab">
                <button type="button" class="btn btn-info">
                    Cấu hình bank
                </button>
            </a>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="{{ route($controllerName, ['key' => 'payment-time-setting']) }}" class="tab">
                <button type="button" class="btn btn-warning">
                    Cấu hình hạn thanh toán
                </button>
            </a>
        </div>
    </div>
</div>

