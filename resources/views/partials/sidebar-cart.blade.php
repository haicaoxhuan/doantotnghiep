<div class="sidebar-cart-active">
    <div class="sidebar-cart-all">
        <a class="cart-close" href="{{route('destroy.cart')}}"><i class="pe-7s-close"></i></a>
        <div class="cart-content">
            <h3>Shopping Cart</h3>
            <ul>
                @foreach (Cart::content() as $cart)
                <li>
                    <div class="cart-img">
                        <a href="{{route('front.product', ['id' => $cart->id])}}"><img src="{{ asset('images/' . $cart->options->images[0]->images) }}" alt=""></a>
                    </div>
                    <div class="cart-title">
                        <h4><a href="{{route('front.product', ['id' => $cart->id])}}">{{$cart->name}}</a></h4>
                        <span>{{$cart->qty}} x ${{number_format($cart->price, 2)}}	</span>
                    </div>
                    <div class="cart-delete">
                        <a href="{{route('delete.cart', ['rowId' => $cart->rowId])}}">×</a>
                    </div>
                </li>
                @endforeach
                
            </ul>
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