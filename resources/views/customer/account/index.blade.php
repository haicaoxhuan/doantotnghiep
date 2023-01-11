@extends('layout.master')

@section('addcss')
@endsection

@section('body')
    <div class="breadcrumb-area bg-gray-4 breadcrumb-padding-1">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2 data-aos="fade-up" data-aos-delay="200">Shop</h2>
                <ul data-aos="fade-up" data-aos-delay="400">
                    <li><a href="index.html">Home</a></li>
                    <li><i class="ti-angle-right"></i></li>
                    <li>Shop Sidebar</li>
                </ul>
            </div>
        </div>
        <div class="breadcrumb-img-1" data-aos="fade-right" data-aos-delay="200">
            <img src="{{ asset('assets/images/banner/breadcrumb-1.png') }}" alt="">
        </div>
        <div class="breadcrumb-img-2" data-aos="fade-left" data-aos-delay="200">
            <img src="{{ asset('assets/images/banner/breadcrumb-2.png') }}" alt="">
        </div>
    </div>
    <div class="my-account-wrapper pb-100 pt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            @include('customer.partials.tab-account')
                            <!-- My Account Tab Menu End -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <!-- Dashboard -->
                                    @include('customer.account.dashboard')
                                    <!-- Dashboard End -->
                                    <!-- Account Detail -->
                                    @include('customer.account.account-detail')
                                    <!-- Account Detail End-->
                                    <!-- Address -->
                                    @include('customer.account.address')
                                    <!-- Address End-->
                                    <!-- Order-->
                                    @include('customer.account.history')
                                    <!-- Order End-->
                                </div>
                            </div>
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('addjs')
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endsection
