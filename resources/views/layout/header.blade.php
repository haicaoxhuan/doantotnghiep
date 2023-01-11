<header class="header-area header-responsive-padding header-height-1">
    @php
        $categorys = App\Models\Category::all();
        $brands = App\Models\Brand::all();
    @endphp
    <div class="header-bottom sticky-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="logo">
                        <a href="index.html"><img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo"></a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="main-menu text-center">
                        <nav>
                            <ul>
                                <li><a href="/">HOME</a>
                                </li>
                                <li><a href="{{ route('shop') }}">SHOP</a>
                                    <ul class="mega-menu-style mega-menu-mrg-1">
                                        <li>
                                            <ul>
                                                <li>
                                                    <a class="dropdown-title" href="">CATEGORY</a>
                                                    <ul>
                                                        @foreach ($categorys as $item)
                                                            <li><a
                                                                    href="{{ route('shop.category', ['slugCate' => $item->slug]) }}">{{ $item->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a class="dropdown-title" href="#">BRANDS</a>
                                                    <ul>
                                                        @foreach ($brands as $item)
                                                            <li><a href="">{{ $item->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#">PAGES</a>
                                    <ul class="sub-menu-style">
                                        <li><a href="about-us.html">about us </a></li>
                                        <li><a href="cart.html">cart page</a></li>
                                        <li><a href="checkout.html">checkout </a></li>
                                        <li><a href="my-account.html">my account</a></li>
                                        <li><a href="wishlist.html">wishlist </a></li>
                                        <li><a href="compare.html">compare </a></li>
                                        <li><a href="contact-us.html">contact us </a></li>
                                        <li><a href="login-register.html">login / register </a></li>
                                    </ul>
                                </li>
                                <li><a href="blog.html">BLOG</a>
                                    <ul class="sub-menu-style">
                                        <li><a href="blog.html">blog standard </a></li>
                                        <li><a href="blog-sidebar.html">blog sidebar</a></li>
                                        <li><a href="blog-details.html">blog details</a></li>
                                    </ul>
                                </li>
                                <li><a href="about-us.html">ABOUT</a></li>
                                <li><a href="contact-us.html">CONTACT US</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="header-action-wrap">
                        <div class="header-action-style header-search-1">
                            <a class="search-toggle" href="#">
                                <i class="pe-7s-search s-open"></i>
                                <i class="pe-7s-close s-close"></i>
                            </a>
                            <div class="search-wrap-1">
                                <form action="">
                                    <input name="search" placeholder="Search products…" type="text"
                                        value="{{ request('search') }}">
                                    <button type="submit" class="button-search"><i class="pe-7s-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="main-menu header-action-style">
                            <nav>
                                <ul>
                                    <li>
                                        @if (Auth::guard('customer')->check())
                                        <a title="Login Register" href="#" ><i class="pe-7s-user"></i></a>
                                        <ul class="sub-menu-style" style="width: 135px; height: 100px; ">
                                            <li><a href="{{route('customer.account')}}" style="font-size:15px">Thông tin</a></li>
                                            <li><a onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{route('customer.logout')}}" style="font-size:15px ">Đăng xuất</a></li>
                                              <form id="logout-form" action="{{ route('customer.logout') }}" method="POST">
                                                @csrf
                                              </form>
                                        </ul>
                                        @else
                                        <a title="Login Register" href="{{ route('customer.auth') }}"><i class="pe-7s-user"></i></a>
                                        @endif
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header-action-style">
                            <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                        </div>
                        <div class="header-action-style header-action-cart">
                            <a class="cart-active" href="#"><i class="pe-7s-shopbag"></i>
                                <span class="product-count bg-black cart-count">0</span>
                            </a>
                        </div>
                        <div class="header-action-style d-block d-lg-none">
                            <a class="mobile-menu-active-button" href="#"><i class="pe-7s-menu"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
