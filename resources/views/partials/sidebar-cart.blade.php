<div class="sidebar-cart-active">
    <div class="sidebar-cart-all">
        <a class="cart-close" ><i class="pe-7s-close"></i></a>
        <div class="cart-content">
            <h3>Shopping Cart</h3>
            @include('partials.mini-cart')
            <div class="cart-total">
                <h4>Subtotal: <span>{{Cart::subtotal()}}</span></h4>
            </div>
            <div class="cart-btn btn-hover">
                <a class="theme-color" href="{{route('cart')}}">view cart</a>
            </div>
            <div class="checkout-btn btn-hover">
                <a class="theme-color" href="{{route('checkout')}}">checkout</a>
            </div>
        </div>
    </div>
</div>