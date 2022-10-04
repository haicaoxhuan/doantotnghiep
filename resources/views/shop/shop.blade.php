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
            <img src="assets/images/banner/breadcrumb-1.png" alt="">
        </div>
        <div class="breadcrumb-img-2" data-aos="fade-left" data-aos-delay="200">
            <img src="assets/images/banner/breadcrumb-2.png" alt="">
        </div>
    </div>
    <div class="shop-area shop-page-responsive pt-100 pb-100">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">
                    <div class="shop-topbar-wrapper mb-40">
                        <div class="shop-topbar-left" data-aos="fade-up" data-aos-delay="200">

                        </div>
                        <div class="shop-topbar-right" data-aos="fade-up" data-aos-delay="400">
                            <form action="">
                                <div class="shop-sorting-area">
                                    <select name="sort_by" class="nice-select nice-select-style-1" onchange="this.form.submit();">
                                        <option {{request('sort_by') == 'latest' ? 'selected' : ''}} value="latest">Default</option>
                                        <option {{request('sort_by') == 'oldest' ? 'selected' : ''}} value="oldest">Oldest</option>
                                        <option {{request('sort_by') == 'name-asc' ? 'selected' : ''}} value="name-asc">Name: A->Z</option>
                                        <option {{request('sort_by') == 'name-desc' ? 'selected' : ''}} value="name-desc">Name: Z->A</option>
                                        <option {{request('sort_by') == 'price-asc' ? 'selected' : ''}} value="price-asc">Price Ascending</option>
                                        <option {{request('sort_by') == 'price-desc' ? 'selected' : ''}} value="price-desc">Price Decrease</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="shop-bottom-area">
                        <div class="tab-content jump">
                            <div id="shop-1" class="tab-pane active">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                            <div class="product-wrap mb-35" data-aos="fade-up" data-aos-delay="200">
                                                @include('partials.product-item')
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="sidebar-wrapper">
                        <div class="sidebar-widget mb-40" data-aos="fade-up" data-aos-delay="200">
                            <div class="search-wrap-2">
                                <form class="search-2-form" action="shop">
                                    <input placeholder="Search*" type="text" name="search" value="{{request('search')}}">
                                    <button type="submit" class="button-search"><i class=" ti-search "></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget sidebar-widget-border mb-40 pb-35" data-aos="fade-up"
                            data-aos-delay="200">
                            <div class="sidebar-widget-title mb-30">
                                <h3>Filter By Price</h3>
                            </div>
                            <div class="price-filter">
                                <div id="slider-range"></div>
                                <div class="price-slider-amount">
                                    <div class="label-input">
                                        <label>Price:</label>
                                        <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                    </div>
                                    <button type="button">Filter</button>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget sidebar-widget-border mb-40 pb-35" data-aos="fade-up"
                            data-aos-delay="200">
                            <div class="sidebar-widget-title mb-25">
                                <h3>Product Categories</h3>
                            </div>
                            <div class="sidebar-list-style">
                                <ul>
                                    <li><a href="shop.html">Accessories <span>4</span></a></li>
                                    <li><a href="shop.html">Book <span>9</span></a></li>
                                    <li><a href="shop.html">Clothing <span>5</span></a></li>
                                    <li><a href="shop.html">Homelife <span>3</span></a></li>
                                    <li><a href="shop.html">Kids & Baby <span>4</span></a></li>
                                    <li><a href="shop.html">Stationery <span>8</span></a></li>
                                    <li><a href="shop.html">Health & Beauty <span>3</span></a></li>
                                    <li><a href="shop.html">Home Appliances <span>4</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget" data-aos="fade-up" data-aos-delay="200">
                            <div class="sidebar-widget-title mb-25">
                                <h3>Tags</h3>
                            </div>
                            <div class="sidebar-widget-tag">
                                <a href="#">All, </a>
                                <a href="#">Clothing, </a>
                                <a href="#"> Kids, </a>
                                <a href="#">Accessories, </a>
                                <a href="#">Stationery, </a>
                                <a href="#">Homelife, </a>
                                <a href="#">Appliances, </a>
                                <a href="#">Clothing, </a>
                                <a href="#">Baby, </a>
                                <a href="#">Beauty </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
