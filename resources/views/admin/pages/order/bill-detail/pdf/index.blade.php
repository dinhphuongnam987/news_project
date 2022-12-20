@php
    use App\Helpers\Template as Template;
    $total = 0;
    $templateStatus = config('zvn.template.status');
    $status = $templateStatus[$billDetail[0]['status']];
    $hotline = $generalSetting['hotline'];
    $address = $generalSetting['address'];
    $email = $generalSetting['email'];
    $logo = public_path(('images\setting\\' . $generalSetting['thumb']));
    $userName = $billDetail[0]['name'];
    $userEmail = $billDetail[0]['email'];
    $userPhone = $billDetail[0]['phone'];
    $MaHD = $billDetail[0]['MaHD'];
    $date = $billDetail[0]['created_at'];
@endphp

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Hóa đơn</title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'DejaVu Sans';
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

            img {
                object-fit: cover;
            }

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: 'DejaVu Sans';
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="{{ $logo }}" style="width: 100%; max-width: 300px" />
								</td>

								<td>
									Mã #: {{ $MaHD }}<br />
									Ngày tạo: {{ $date }}<br />
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
                                    {{ $address }}<br/>
                                    {{ $hotline }}<br/>
                                    {{ $email }}
								</td>

								<td>
									{{ $userName }}<br />
									{{ $userEmail }}<br />
									{{ $userPhone }}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Trạng thái giao dịch</td>

					<td>{{ $status['name'] }}</td>
				</tr>

				{{-- <tr class="details">
					<td>Check</td>

					<td>1000</td>
				</tr> --}}

				<tr class="heading">
					<td>Sản phẩm</td>
					<td>Giá</td>
				</tr>
                @foreach($billDetail as $val)
                    @php
                        $name = $val['sp'];
                        $qty  = $val['quantity'];
                        $price = $val['price'];
                        $sub_total = $qty * $price;
                        $total += $sub_total;
                    @endphp
                    <tr class="item">
                        <td>{{ $name }} x<strong> {{ $qty }} </strong></td>
                        <td>{{ Template::currencyFormat($sub_total) }}</td>
                    </tr>
                @endforeach
				<tr class="total">
					<td></td>

					<td>Tổng: {{ Template::currencyFormat($total) }}</td>
				</tr>
			</table>
		</div>
	</body>
</html>