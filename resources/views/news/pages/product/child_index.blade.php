@php 
    use App\Helpers\Template;
@endphp

<div class="row">
    @if(!@empty($items))
        @foreach($items as $item)
            @php 
                $price = Template::currencyFormat($item['price']);
                $original_price = Template::currencyFormat($item['original_price']);
            @endphp
            <div class="col-md-4 mb-3">
                <div class="item">
                    <img src="{{ asset('images/product/' . $item['thumb']) }}" alt="">
                    <span class="title">{{ $item['name']}}</span>
                    <p class="description">{!! $item['description'] !!}</p>
                    <span class="quantity_remaining">Số lượng: {{ $item['quantity_remaining'] }}</span>
                    Giá: <span class="original_price">{{ $original_price }}</span>
                    <span class="price">{{ $price }}</span>
                    <button data-url="{{ route($controllerName .'/add-cart', ['id' => $item['id']]) }}" class="btn btn-warning add-cart">Thêm vào giỏ hàng</button>
                </div>
            </div>
        @endforeach
    @endif
</div>
