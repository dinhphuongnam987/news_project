<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th><b>Tên</b></th>
            <th><b>Giá (USD)</b></th>
            <th><b>Biến động trong 24h</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($itemsCoin as $item)
            @php
                $price = number_format($item['price'], 2);
                $percentChange24h = number_format($item['percent_change_24h'], 5);
                $color = 'text-danger';
                if ($percentChange24h > 0) $color = 'text-success';
                $percentChange24h = sprintf('<span class="%s">%s</span>', $color, $percentChange24h);
            @endphp
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $price }}</td>
                <td>{!! $percentChange24h !!}</td>
            </tr>
        @endforeach
    </tbody>
</table>
