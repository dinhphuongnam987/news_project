@php
    use App\Helpers\Template as Template;
    use App\Helpers\Hightlight as Hightlight;
@endphp
<div class="x_content">
    <div class="table-responsive">
        @if(!empty($items))
        @include ('admin.templates.zvn_notify')
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">STT</th>
                    <th class="column-title">Tên</th>
                    <th class="column-title">Giá tiền</th>
                    <th class="column-title">Số lượng</th>
                    <th class="column-title">Thành tiền</th>
                    <th class="column-title">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 0;
                    $total = 0;
                @endphp
                @foreach ($items as $key => $val)
                    @php
                        $index = $index + 1;
                        $class = $index % 2 == 0 ? 'even' : 'odd';
                        $id = $val['id'];
                        $name = $val['name'];
                        $qty_remaining = $val['qty_remaining'];
                        $quantity = $val['quantity'] < $qty_remaining ? $val['quantity'] : $qty_remaining;
                        $price = $val['price'];
                        $sub_total = $val['sub_total'];
                        $total = $val['total'];
                        $urlChangeQty = route("$controllerName/change-qty", ['id' => $id, 'quantity' => 'quantity']);
                        $urlDelete = route("$controllerName/delete-cart", ['id' => $id]);
                    @endphp

                    <tr class="{{ $class }} pointer">
                        <td>{{ $index }}</td>
                        <td>{{ $name }}</td>
                        <td class="price">{{ Template::currencyFormat($price) }}</td>
                        <td witdh="5%" class="qty">
                            <input type="number" value="{{ $quantity }}" data-url="{{ $urlChangeQty }}" min=1
                                max={{ $qty_remaining }}>
                        </td>
                        <td class="sub-total" data-id="{{ $id }}">{{ Template::currencyFormat($sub_total) }}
                        </td>
                        <td class="last">
                            <a href="{{ $urlDelete }}">
                                <button type="button" class="delete-cart btn btn-danger">
                                    Xóa
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>Tổng tiền:
            <span id="total">{{ Template::currencyFormat($total) }}</span>
        </div>

        <a href="{{ route("$controllerName/check-out") }}">
            <button class="btn btn-info">
                Thanh toán
            </button>
        </a>

        @else 
            <div style="text-align: center">
                <h3>Giỏ hàng của bạn hiện tại chưa có gì.</h3>
                <h3>Vui lòng quay lại trang sản phẩm để mua hàng!</h3>
            </div>
        @endif
    </div>
</div>
