<div class="sidebar-cart-active">
    <div class="sidebar-cart-all">
        <a class="cart-close"><i class="pe-7s-close"></i></a>
        <div class="cart-content">
            <h3>Shopping Cart</h3>
            @include('partials.mini-cart')
            @php
            $sumMini = 0;
                foreach ($carts as $cart) {
                    $miniSubtotal = $cart->quantity * $cart->price;
                    $sumMini += $miniSubtotal;
                }
            @endphp
            <div class="cart-total">
                <h4>Subtotal: <span class="mini-cart-subtotal">{{ number_format($sumMini) }}đ</span></h4>
            </div>
            <div class="cart-btn btn-hover">
                <a class="theme-color" href="{{ route('cart') }}">view cart</a>
            </div>
            <div class="checkout-btn btn-hover">
                <a class="theme-color" href="{{ route('checkout') }}">checkout</a>
            </div>
        </div>
    </div>
</div>
