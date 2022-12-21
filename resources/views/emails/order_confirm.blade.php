@php
    use App\Helpers\Template as Template;
    $total = Template::currencyFormat($order['total']);
@endphp

<h1>Cảm ơn quý khách vì đã tin tưởng và chọn dịch vụ của chúng tôi!</h1>
<h3>Quý khách vui lòng chuyển <strong>{{ $total }}</strong> với nội dung chuyển khoản 
    <strong>{{ $order['MaHD'] }}</strong> trước <strong>{{ $order['deadline_payment'] }}</strong>
    đến số tài khoản <strong>{{ $bank_setting['account_number'] }}</strong>
    ngân hàng <strong>{{ $bank_setting['bank_name'] }}</strong>.
    Sau khi quý khách chuyển khoản thành công sẽ nhận hóa đơn chi tiết của đơn hàng qua email này!
</h3>