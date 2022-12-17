
@php
  use App\Helpers\Template as Template;
  $index = 0;
  $total = 0;
@endphp
@if (!empty($items))
    <h3>Hóa đơn</h3>
    <table class="table table-hover table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Giỏ hàng</th>
                <th scope="col">
                  <i class="fa fa-shopping-cart" aria-hidden="true"></i> 
                  {{ count($items) }}
                </th>
            </tr>
        </thead>
        <tbody>
          @foreach ($items as $item)
              @php
                  $index += 1;
                  $total = $item['total'];
              @endphp
                  <tr>
                      <th scope="row">{{ $index }}</th>
                      <td>{{ $item['name'] }}</td>
                      <td>{{ Template::currencyFormat($item['sub_total']) }}</td>
                  </tr>
          @endforeach
          <tr>
            <td colspan="2">Tổng tiền</td>
            <td>{{ Template::currencyFormat($total) }}</td>
          </tr>
        </tbody>
    </table>
@endif
