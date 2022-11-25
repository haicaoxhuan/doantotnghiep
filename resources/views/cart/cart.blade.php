@extends('layout.master')

@section('addcss')
@endsection

@section('body')
    @php
        $sum = 0;
    @endphp
    <div class="breadcrumb-area bg-gray-4 breadcrumb-padding-1">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>Cart</h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><i class="ti-angle-right"></i></li>
                    <li>Cart</li>
                </ul>
            </div>
        </div>
        <div class="breadcrumb-img-1">
            <img src="assets/images/banner/breadcrumb-1.png" alt="">
        </div>
        <div class="breadcrumb-img-2">
            <img src="assets/images/banner/breadcrumb-2.png" alt="">
        </div>
    </div>
    <div class="cart-area pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="">
                        <div class="cart-table-content">
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="width-thumbnail"></th>
                                            <th class="width-name">Product</th>
                                            <th class="width-price"> Price</th>
                                            <th class="width-quantity">Quantity</th>
                                            <th class="width-subtotal">Subtotal</th>
                                            <th class="width-remove"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $cart)
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <a href="{{ route('front.product', ['id' => $cart->id]) }}"><img src="{{ asset($cart->images) }}" alt=""></a>
                                                </td>
                                                <td class="product-name">
                                                    <h5><a href="{{ route('front.product', ['id' => $cart->id]) }}">{{ $cart->product_name }}</a></h5>
                                                </td>
                                                <td class="product-cart-price"><span
                                                        class="amount">${{ number_format($cart->price) }}</span></td>
                                                <td class="cart-quality">
                                                    <div class="product-quality">
                                                        <div class="dec qtybutton">-</div>
                                                        <input class="cart-plus-minus-box input-text qty text"
                                                            name="qtybutton" value="{{ $cart->quantity }}"
                                                            data-rowid="{{ $cart->rowId }}" id="qtyCart">
                                                        <div class="inc qtybutton">+</div>
                                                    </div>
                                                </td>
                                                @php
                                                    $subtotal = $cart->price * $cart->quantity;
                                                    $sum += $subtotal;
                                                @endphp
                                                <td class="product-total">
                                                    <span>${{ number_format($subtotal) }}</span>
                                                </td>
                                                <td class="product-remove"><a href="{{route('delete.cart', ['id' => $cart->cartDetailId])}}"><i class=" ti-trash "></i></a></td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-update btn-hover">
                                        <a href="{{ route('shop') }}">Continue Shopping</a>
                                    </div>
                                    <div class="cart-clear-wrap">
                                        <div class="cart-clear btn-hover">
                                        </div>
                                        <div class="cart-clear btn-hover">
                                                {{-- <a href="">Clear Cart</a> --}}
                                                <a href="{{ route('destroy.cart') }}">Clear Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="cart-calculate-discount-wrap mb-40">
                        <h4></h4>
                        <div class="calculate-discount-content">
                            <div class="select-style mb-15">
                                
                            </div>
                            <div class="select-style mb-15">
                                
                            </div>
                            <div class="input-style">
                            </div>
                            <div class="input-style">
                            </div>
                            <div class="calculate-discount-btn btn-hover">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="cart-calculate-discount-wrap mb-40">
                        <h4>Coupon Discount </h4>
                        <div class="calculate-discount-content">
                            <p>Enter your coupon code if you have one.</p>
                            <div class="input-style">
                                <input type="text" placeholder="Coupon code">
                            </div>
                            <div class="calculate-discount-btn btn-hover">
                                <a class="btn theme-color" href="#">Apply Coupon</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="grand-total-wrap">
                        <div class="grand-total-content">
                            <h3>Subtotal <span>{{ $sum }}</span></h3>
                            <div class="grand-shipping">
                                <span>Discount: <span></span></span>
                            </div>
                            <div class="grand-total">
                                <h4>Total <span>{{ $sum }}</span></h4>
                            </div>
                        </div>
                        <div class="grand-total-btn btn-hover">
                            <a class="btn theme-color" href="{{route('checkout')}}">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addjs')
    <script src="{{ asset('assets/js/price.min.js') }}"></script>
@endsection
