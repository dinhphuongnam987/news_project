@php
    use App\Helpers\Template as Template;
    $templateStatus = config('zvn.template.status');
@endphp

<table>
    <thead>
    <tr>
        <th>Tên</th>
        <th>Email</th>
        <th>Số Điện Thoại</th>
        <th>Mã Hóa Đơn</th>
        <th>Chi Tiết Hóa Đơn</th>
        <th>Thời Gian Đặt</th>
        <th>Hạn Thanh Toán</th>
        <th>Trạng Thái Thanh Toán</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->name }}</td>
            <td>{{ $order->email }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ $order->MaHD }}</td>
            <td>
                <a href="{{ route("$controllerName/bill-detail", ['MaHD' => $order->MaHD]) }}" target="_blank">
                    Xem chi tiết
                </a>
            </td>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->deadline_payment }}</td>
            <td>{{ $templateStatus[$order->status]['name'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>