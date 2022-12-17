<div class="row">
    <div class="col-md-8">
        @include('news.pages.product.cart.checkout.form')
    </div>
    <div class="col-md-4">
        @include('news.pages.product.cart.checkout.bill', ['items' => $cartDetail])
    </div>
</div>