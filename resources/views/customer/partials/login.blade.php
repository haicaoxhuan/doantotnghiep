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
                            <a class="active" data-bs-toggle="tab" href="#lg1">
                                <h4> login </h4>
                            </a>
                            <a data-bs-toggle="tab" href="#lg2">
                                <h4> register </h4>
                            </a>
                        </div>
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    @error('error')
                                        <div class="alert alert-danger text-center" id="login-alert" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="login-register-form">
                                        <form action="{{ route('customer.login') }}" method="post">
                                            @csrf
                                            <input type="text" name="email" placeholder="Email">
                                            <input type="password" name="password" placeholder="Password">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox">
                                                <label>Remember me</label>
                                                <a href="#">Forgot Password?</a>
                                            </div>
                                            <div class="button-box btn-hover">
                                                <button type="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="lg2" class="tab-pane">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="{{route('customer.register')}}" method="post">
                                            @csrf
                                            <input type="text" name="cusname" placeholder="Name">
                                            <input type="email" name="cusemail" placeholder="Email" >
                                            <input type="password" name="cuspassword" placeholder="Password">
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
    </div>
@endsection
@section('addjs')
<script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $("#login-alert").fadeTo(2000, 500).slideUp(500, function() {
        $("#login-alert").slideUp(500);
    });
</script>
@endsection
