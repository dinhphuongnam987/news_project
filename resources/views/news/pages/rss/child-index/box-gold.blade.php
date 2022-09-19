<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th><b>Loại vàng</b></th>
            <th><b>Mua vào</b></th>
            <th><b>Bán ra</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($itemsGold as $item)
            <tr>
                <td>{{ $item['type'] }}</td>
                <td>{{ $item['buy'] }}</td>
                <td>{{ $item['sell'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
