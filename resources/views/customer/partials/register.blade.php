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
    <div class="login-register-area pb-100 pt-95">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 offset-lg-2">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a href="{{ route('customer.auth') }}">
                                <h4> login </h4>
                            </a>
                            <a class="active" href="{{ route('customer.viewRegister') }}">
                                <h4> register </h4>
                            </a>
                        </div>
                        <div class="tab-pane">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="{{ route('customer.register') }}" method="post">
                                        @csrf
                                        <input type="text" name="cusname" placeholder="Name">
                                        @error('cusname')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="email" name="cusemail" placeholder="Email">
                                        @error('cusemail')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="password" name="cuspassword" placeholder="Password">
                                        @error('cuspassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="button-box btn-hover">
                                            <button type="submit">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('addjs')
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $("#login-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#login-alert").slideUp(500);
        });
    </script>
    <script src="{{asset('assets/js/main.js')}}"></script>
@endsection