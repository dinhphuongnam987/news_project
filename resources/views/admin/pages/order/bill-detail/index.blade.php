@php
  use App\Helpers\Template as Template;
  $total = 0;
  $templateStatus = config('zvn.template.status');
  $status = $templateStatus[$billDetail[0]['status']];
  $xhtmlButtonStatus = sprintf('<button type="button" class="btn %s btn-lg btn-block">
                                %s
                            </button>', $status['class'], $status['name']);
  $userName = $billDetail[0]['name'];
  $MaHD = $billDetail[0]['MaHD'];
  $date = $billDetail[0]['created_at'];
  $address = $generalSetting['address'];
  $hotline = $generalSetting['hotline'];
@endphp

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!------ Include the above in your HEAD tag ---------->

<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong>News Vn</strong>
                        <br>
                        {{ $address }}
                        <br>
                        <abbr title="Phone">P:</abbr> {{ $hotline }}
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>{{ $date }}</em>
                    </p>
                    <p>
                        <em>Mã #: {{ $MaHD }}</em>
                    </p>
                    <p>
                        <em>Anh/Chị: {{ $userName }}</em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Hóa Đơn</h1>
                </div>
                </span>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th class="text-center">#</th>
                            <th class="text-center">Giá</th>
                            <th class="text-center">Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($billDetail as $val)
                            @php
                                $name = $val['sp'];
                                $qty  = $val['quantity'];
                                $price = $val['price'];
                                $sub_total = $qty * $price;
                                $total += $sub_total;
                            @endphp
                            <tr>
                                <td class="col-md-8"><em>{{ $name }}</em></h4></td>
                                <td class="col-md-1" style="text-align: center">{{ $qty }}</td>
                                <td class="col-md-1 text-center">{{ Template::currencyFormat($price) }}</td>
                                <td class="col-md-2 text-center">{{ Template::currencyFormat($sub_total) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="text-right"><h4><strong>Tổng tiền: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong>{{ Template::currencyFormat($total) }}</strong></h4></td>
                        </tr>
                    </tbody>
                </table>
                {!! $xhtmlButtonStatus !!}
            </div>
        </div>
    </div>