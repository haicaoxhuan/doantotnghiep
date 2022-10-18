@extends('layout.master')

@section('addcss')
@endsection

@section('body')
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
                                                    <a href="{{ route('front.product', ['id' => $cart->id]) }}"><img
                                                            src="{{ asset('images/' . $cart->options->images[0]->images) }}"
                                                            alt=""></a>
                                                </td>
                                                <td class="product-name">
                                                    <h5><a
                                                            href="{{ route('front.product', ['id' => $cart->id]) }}">{{ $cart->name }}</a>
                                                    </h5>
                                                </td>
                                                <td class="product-cart-price"><span
                                                        class="amount">${{ number_format($cart->price, 2) }}</span></td>
                                                <td class="cart-quality">
                                                    <div class="product-quality">
                                                        <div class="dec qtybutton">-</div>
                                                        <input class="cart-plus-minus-box input-text qty text"
                                                            name="qtybutton" value="{{ $cart->qty }}"
                                                            data-rowid="{{ $cart->rowId }}" id="qtyCart">
                                                        <div class="inc qtybutton">+</div>
                                                    </div>
                                                </td>
                                                <td class="product-total">
                                                    <span>${{ number_format($cart->price * $cart->qty, 2) }}</span>
                                                </td>
                                                <td class="product-remove"><a
                                                        href="{{ route('delete.cart', ['rowId' => $cart->rowId]) }}"><i
                                                            class=" ti-trash "></i></a></td>
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
                        <h4>Calculate shipping </h4>
                        <div class="calculate-discount-content">
                            <div class="select-style mb-15">
                                <select class="select-two-active">
                                    <option>Bangladesh</option>
                                    <option>Bahrain</option>
                                    <option>Azerbaijan</option>
                                    <option>Barbados</option>
                                    <option>Barbados</option>
                                </select>
                            </div>
                            <div class="select-style mb-15">
                                <select class="select-two-active">
                                    <option>State / County</option>
                                    <option>Bahrain</option>
                                    <option>Azerbaijan</option>
                                    <option>Barbados</option>
                                    <option>Barbados</option>
                                </select>
                            </div>
                            <div class="input-style">
                                <input type="text" placeholder="Town / City">
                            </div>
                            <div class="input-style">
                                <input type="text" placeholder="Postcode / ZIP">
                            </div>
                            <div class="calculate-discount-btn btn-hover">
                                <a class="btn theme-color" href="#">Update</a>
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
                            <h3>Subtotal <span>{{ $subtotal }}</span></h3>
                            <div class="grand-shipping">
                                <span>Shipping fee: <span>phí ship ở đây</span></span>
                            </div>
                            <div class="grand-total">
                                <h4>Total <span>{{ $total }}</span></h4>
                            </div>
                        </div>
                        <div class="grand-total-btn btn-hover">
                            <a class="btn theme-color" href="checkout.html">Proceed to checkout</a>
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
