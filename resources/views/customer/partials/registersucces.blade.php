@extends('layout.master')

@section('addcss')
@endsection

@section('body')
<div class="breadcrumb-area bg-gray-4 breadcrumb-padding-1">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>Login - Register </h2>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><i class="ti-angle-right"></i></li>
                <li>Login - Register </li>
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
<div class="about-us-area pt-100 pb-100">
    <div class="container">
        <div class="row align-items-center flex-row-reverse" style="justify-content: center">
            <div class="col-lg-6">
                <div class="about-content text-center">
                    <h1 data-aos="fade-up" data-aos-delay="300">Đăng ký tài khoản thành công </h1>
                    <p data-aos="fade-up" data-aos-delay="400">Bạn đã đăng ký tài khoản thành công<br>Hãy đăng nhập để tiếp tục mua hàng</p>
                    <p class="mrg-inc" data-aos="fade-up" data-aos-delay="500"></p>
                    <div class="btn-style-3 btn-hover" data-aos="fade-up" data-aos-delay="600">
                        <a class="btn border-radius-none" href="{{route('customer.auth')}}">Đăng nhập ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('addjs')
@endsection