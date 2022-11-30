<ul class="mini-cart">
    @foreach ($carts as $cart)
    <li>
        <div class="cart-img">
            <a href="{{route('front.product', ['id' => $cart->id])}}"><img src="{{ asset($cart->images) }}" alt=""></a>
        </div>
        <div class="cart-title">
            <h4><a href="{{route('front.product', ['id' => $cart->id])}}">{{$cart->product_name}}</a></h4>
            <span>{{$cart->quantity }} x {{number_format($cart->price)}}đ	</span>
        </div>
        <div class="cart-delete">
            <a href="{{route('delete.cart', ['id' => $cart->id])}}">×</a>
        </div>
    </li>
    @endforeach
</ul>