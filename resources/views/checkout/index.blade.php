@extends('layout.master')

@section('addcss')
@endsection

@section('body')
    <div class="breadcrumb-area bg-gray-4 breadcrumb-padding-1">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>Checkout </h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><i class="ti-angle-right"></i></li>
                    <li>Checkout </li>
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
    <div class="checkout-main-area pb-100 pt-100">
        <div class="container">
            <div class="customer-zone mb-20">
                
            <div class="customer-zone mb-20">
                <p class="cart-page-title">Have a coupon? <a class="checkout-click3" href="#">Click here to enter your
                        code</a></p>
                <div class="checkout-login-info3">
                    <form action="#">
                        <input type="text" placeholder="Coupon code">
                        <input type="submit" value="Apply Coupon">
                    </form>
                </div>
            </div>
            <div class="checkout-wrap pt-30">
                <form action="{{route('checkout.addorder')}}" method="post" >
                    @csrf
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="billing-info-wrap">
                                <h3>Billing Details</h3>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-20">
                                            <label>Name <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" name="fullname">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="billing-info mb-20">
                                            <label>Phone <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="billing-info mb-20">
                                            <label>Email Address <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" name="email">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-select select-style mb-20">
                                            <label>City <abbr class="required" title="required">*</abbr></label>
                                            <select class="select-two-active choose city" name="city" id="city">
                                                <option value="">-Select city-</option>
                                                @foreach ($cities as $key => $city)
                                                    <option name="namecity" value="{{ $city->matp }}">
                                                        {{ $city->name_city }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="billing-select select-style mb-20">
                                            <label>District <abbr class="required" title="required">*</abbr></label>
                                            <select class="select-two-active choose district " name="district"
                                                id="district">
                                                <option name="namedistrict" value="">-Select district-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="billing-select select-style mb-20">
                                            <label>Wards <abbr class="required" title="required">*</abbr></label>
                                            <select class="select-two-active wards" id="wards" name="wards">
                                                <option name="namewards" value="">-Select wards-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="billing-info mb-20">
                                            <label>Detail Address <abbr class="required" title="required">*</abbr></label>
                                            <input class="billing-address" placeholder="" type="text" name="address">
                                        </div>
                                    </div>
                                </div>

                                <div class="additional-info-wrap">
                                    <label>Order notes</label>
                                    <textarea placeholder="" name="message" name="note"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="your-order-area">
                                <h3>Your order</h3>
                                <div class="your-order-wrap gray-bg-4">
                                    <div class="your-order-info-wrap">
                                        <div class="your-order-info">
                                            <ul>
                                                <li>Product <span>Total</span></li>
                                            </ul>
                                        </div>
                                        @php
                                            $sum = 0;
                                        @endphp
                                        <div class="your-order-middle">
                                            <ul>
                                                @foreach ($carts as $cart)
                                                    <li>{{ $cart->product_name }} X {{ $cart->quantity }}<span>{{ number_format($cart->price * $cart->quantity) }}??? </span></li>
                                                    @php
                                                        $subtotal = $cart->price * $cart->quantity;
                                                        $sum += $subtotal;
                                                    @endphp
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="your-order-info order-subtotal">
                                            <ul>
                                                <li>Subtotal <span>{{number_format($sum)}}??? </span></li>
                                            </ul>
                                        </div>
                                        @php
                                            if (isset($coupon)){
                                                $value = $coupon->value;
                                                $total = $sum - ($sum*$value)/100;
                                            }else{
                                                $total = $sum;
                                            }
                                        @endphp
                                        @if (isset($coupon))
                                        <input type="hidden" name="coupon" value="{{$coupon->id}}">
                                        @endif
                                        <div class="your-order-info order-shipping">
                                            <ul>
                                                <li>Discount 
                                                    @if (isset($coupon))
                                                        <p>{{number_format(($sum*$value)/100)}}???</p>
                                                    @else
                                                        <p>Enter your Discount </p>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="your-order-info order-total">
                                            <ul>
                                                <li>Total <span class="total-checkout">{{number_format($total)}}??? </span></li>
                                                <input name="total" type="hidden" value="{{$total}}">
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <div class="pay-top sin-payment">
                                            <input id="payment_method_1" class="input-radio" type="radio"
                                                value="cheque" checked="checked" name="payment_method">
                                            <label for="payment_method_1"> Direct Bank Transfer </label>
                                        </div>
                                        <div class="pay-top sin-payment">
                                            <input id="payment-method-2" class="input-radio" type="radio"
                                                value="cheque" name="payment_method">
                                            <label for="payment-method-2">Check payments</label>
                                        </div>
                                        <div class="pay-top sin-payment">
                                            <input id="payment-method-3" class="input-radio" type="radio"
                                                value="cheque" name="payment_method">
                                            <label for="payment-method-3">Cash on delivery </label>
                                        </div>
                                        <div class="pay-top sin-payment sin-payment-3">
                                            <input id="payment-method-4" class="input-radio" type="radio"
                                                value="cheque" name="payment_method">
                                            <label for="payment-method-4">PayPal <img alt=""
                                                    src="assets/images/icon-img/payment.png"></label>
                                            <div class="payment-box payment_method_bacs">
                                                <p>Make your payment directly into our bank account. Please use your Order
                                                    ID as
                                                    the payment reference.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="Place-order btn-hover">
                                    <button type="submit">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('addjs')
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/checkout.js') }}"></script>
@endsection
