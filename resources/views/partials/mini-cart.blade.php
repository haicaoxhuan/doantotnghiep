<ul class="mini-cart">
    @foreach ($carts as $cart)
    <li>
        <div class="cart-img">
            <a href="{{route('front.product', ['id' => $cart->id])}}"><img src="{{ asset($cart->images) }}" alt=""></a>
        </div>
        <div class="cart-title">
            <h4><a href="{{route('front.product', ['id' => $cart->id])}}">{{$cart->product_name}}<span> ({{$cart->color}})</span></a></h4>
            <span class="mini-qty">{{$cart->quantity }} </span><span>x {{number_format($cart->price)}}₫	</span>
        </div>
        <div class="cart-delete">
            <form action="{{route('delete.cart', ['id' => $cart->id])}}" method="post">
            @method('delete')
            <button type="submit">×</button>
            </form>
        </div>
    </li>
    @endforeach
</ul>