@php
    use App\Helpers\Template as Template;
    use App\Helpers\Hightlight as Hightlight;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Tên</th>
                    <th class="column-title">Email</th>
                    <th class="column-title">Số điện thoại</th>
                    <th class="column-title">Mã hóa đơn</th>
                    <th class="column-title">Tùy chọn</th>
                    <th class="column-title">Thời gian đặt</th>
                    <th class="column-title">Hạn thanh toán</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                    @foreach ($items as $key => $val)
                        @php
                            $index           = $key + 1;
                            $class           = ($index % 2 == 0) ? "even" : "odd";
                            $id              = $val['id'];
                            $name            = Hightlight::show($val['name'], $params['search'], 'name');
                            $email           = Hightlight::show($val['email'], $params['search'], 'email');
                            $phone           = Hightlight::show($val['phone'], $params['search'], 'phone');
                            $maHD            = Hightlight::show($val['MaHD'], $params['search'], 'MaHD');
                            $timeOrder       = $val['created_at'];
                            $deadline_pay    = $val['deadline_payment'];
                            $status          = Template::showItemSelect($controllerName, $id, $val['status'], 'status_payment'); 
                            $listBtnAction   = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td >{{ $index }}</td>
                            <td >{{ $name }}</td>
                            <td>{!! $email !!}</td>
                            <td>{!! $phone !!}</td>
                            <td>{!! $maHD !!}
                                <a href="{{ route("$controllerName/bill-detail", ['MaHD' => $val['MaHD']]) }}" target="_blank"
                                    style="margin-left: 10px; color: rgb(2, 112, 255)">Chi tiết
                                </a>
                            </td>
                            <td>
                                <a href="{{ route("$controllerName/bill-detail", ['MaHD' => $val['MaHD'], 'pdf' => 'view']) }}" 
                                    style="margin-right: 10px; color: rgb(2, 112, 255)" target="_blank">Xem PDF</a>
                                <a href="{{ route("$controllerName/bill-detail", ['MaHD' => $val['MaHD'], 'pdf' => 'download']) }}" 
                                    style="margin-right: 10px; color: rgb(2, 112, 255)" target="_blank">Tải PDF</a>
                            </td>
                            <td>{!! $timeOrder !!}</td>
                            <td>{!! $deadline_pay !!}</td>
                            <td width="20%">{!! $status !!}</td>
                            <td class="last">{!! $listBtnAction !!}</td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.templates.list_empty', ['colspan' => 10])
                @endif
            </tbody>
        </table>
        <a href="{{ route($controllerName . '/export') }}" target="_blank" style="color: white">
            <button class="btn btn-warning" style="float: right; margin-right: 30px">
                Xuất danh sách đơn hàng(Excel)
            </button>
        </a>
    </div>
</div>
           