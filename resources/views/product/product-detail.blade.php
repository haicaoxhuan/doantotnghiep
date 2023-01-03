@extends('layout.master')

@section('addcss')
    <link rel="stylesheet" href="{{ asset('assets/css/feproduct.css') }}">
@endsection

@section('body')
    @php
        $request = request();
    @endphp
    <div class="breadcrumb-area bg-gray-4 breadcrumb-padding-1">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2 data-aos="fade-up" data-aos-delay="200">Product Details</h2>
                <ul data-aos="fade-up" data-aos-delay="400">
                    <li><a href="index.html">Home</a></li>
                    <li><i class="ti-angle-right"></i></li>
                    <li>Product Details</li>
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
    <div class="product-details-area pb-100 pt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-details-img-wrap product-details-vertical-wrap" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="product-details-small-img-wrap">
                            <div class="swiper-container product-details-small-img-slider-1 pd-small-img-style">
                                <div class="swiper-wrapper">
                                    @foreach ($product->images as $item)
                                        <div class="swiper-slide">
                                            <div class="product-details-small-img">
                                                <img src={{ asset($item) }} alt="Product Thumnail">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="pd-prev pd-nav-style"> <i class="ti-angle-up"></i></div>
                            <div class="pd-next pd-nav-style"> <i class="ti-angle-down"></i></div>
                        </div>
                        <div class="swiper-container product-details-big-img-slider-1 pd-big-img-style">
                            <div class="swiper-wrapper">
                                @foreach ($product->images as $item)
                                    <div class="swiper-slide">
                                        <div class="easyzoom-style">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href={{ asset($item) }}>
                                                    <img src={{ asset($item) }} alt="">
                                                </a>
                                            </div>
                                            <a class="easyzoom-pop-up img-popup" href={{ asset($item) }}>
                                                <i class="pe-7s-search"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-details-content" data-aos="fade-up" data-aos-delay="400">
                        <h2>{{ $product->name }}</h2>
                        <div class="product-details-price">
                            @if ($product->price_dc != null)
                                <span class="old-price"> {{ number_format($product->price) }}₫ </span>
                                <span class="new-price"> {{ number_format($product->price_dc) }}₫ </span>
                            @else
                                <span class="price-detail" style="font-size: 20px"> {{ number_format($product->price) }}₫
                                </span>
                            @endif
                        </div>
                        <div class="product-details-review">
                            <div class="product-rating ">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $avgRating)
                                        <i class=" fa fa-star"></i>
                                    @else
                                        <i class=" fa fa-star-o"></i>
                                    @endif
                                @endfor
                            </div>
                            <span>( {{ $countRating }} Customer Review )</span>
                        </div>
                        <div class="product-color product-color-active product-details-color">
                            <span>Màu :</span>
                            <ul>
                                @foreach ($product->productDetail as $detail)
                                    <li><a data-color="{{ $detail->color }}" data-id="{{ $detail->id }}"
                                            title="{{ $detail->color }}" class="color"
                                            style="background-color:  {{ $detail->color_code }}"></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="product-details-action-wrap">
                            <div class="product-quality">
                                <input class="cart-plus-minus-box input-text qty text product_qty_{{ $product->id }}"
                                    name="qtybuttonn" value="1">
                            </div>
                            <div class="single-product-cart btn-hover">
                                <form action="">
                                    <input type="hidden" value="{{ $product->id }}"
                                        class="product_id_{{ $product->id }}">
                                    <input type="hidden" value="{{ $product->name }}"
                                        class="product_name_{{ $product->id }}">
                                    {{-- <input type="hidden" value="{{ $product->price }}"
                                    class="product_price_{{ $product->id }}">
                                <input type="hidden" value="{{ $product->price_dc }}"
                                    class="product_price_dc_{{ $product->id }}"> --}}
                                    <input type="hidden" value="{{ $product->images[0] }}"
                                        class="product_images_{{ $product->id }}">
                                </form>
                                <a data-id="{{ $product->id }}" class="add-cart">Add to cart</a>
                            </div>
                            <div class="single-product-wishlist">
                                <a title="Wishlist" href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="single-product-compare">
                                <a title="Compare" href="#"><i class="pe-7s-shuffle"></i></a>
                            </div>
                        </div>
                        <div class="product-details-meta">
                            <ul>
                                <li><span class="title">SKU:</span> {{ $product->sku }}</li>
                                <li><span class="title">Category:</span>
                                    <ul>
                                        @foreach ($category as $item)
                                            <li><a href="#">{{ $item->category_name }}, </a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><span class="title quantity">Số lượng:</span>
                                    <ul class="tag">
                                        <li><a class="qty-detail" href="#">{{ $product->quantity }}</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="social-icon-style-4">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram "></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="description-review-area pb-85">
        <div class="container">
            <div class="description-review-topbar nav" data-aos="fade-up" data-aos-delay="200">
                <a class="active" data-bs-toggle="tab" href="#des-details1"> Description </a>
                <a data-bs-toggle="tab" href="#des-details3" class=""> Reviews </a>
            </div>
            <div class="tab-content">
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-content text-center">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="review-wrapper">
                        <h3>{{ $countRating }} Comment</h3>
                        @foreach ($product->productComments as $item)
                            <div class="single-review">
                                <div class="review-img">
                                    <img src="{{ asset('images/no-cus.png') }}" alt="">
                                </div>
                                <div class="review-content">
                                    <div class="review-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $item->rating)
                                                <i style="color: #e97730" class=" fa fa-star"></i>
                                            @else
                                                <i style="color: #e97730" class=" fa fa-star-o"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <h5><span>{{ $item->customer_id ? $item->customer->name : $item->name }}</span> -
                                        {{ date(
                                            'M
                                                                        d, Y',
                                            strtotime($item->created_at),
                                        ) }}
                                    </h5>
                                    <p>{{ $item->messages }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="ratting-form-wrapper">
                        <h3>Add a Review</h3>
                        <p>Your email address will not be published. Required fields are marked <span>*</span></p>
                        <form action="" method="post">
                            <div class="your-rating-wrap">
                                <div class="personal-rating">
                                    <h6>Your Rating</h6>
                                    <div class="rate">
                                        <input type="radio" id="star5" name="rating" value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="rating" value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="rating" value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" name="rating" value="2" />
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" name="rating" value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                </div>
                            </div>
                            <div class="ratting-form">

                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="customer_id"
                                    value="{{ \Illuminate\Support\Facades\Auth::user()->id ?? null }}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="rating-form-style mb-15">
                                            <label>Name <span>*</span></label>
                                            <input type="text" name="name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="rating-form-style mb-15">
                                            <label>Email <span>*</span></label>
                                            <input type="email" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="rating-form-style mb-15">
                                            <label>Your review <span>*</span></label>
                                            <textarea name="messages"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-submit">
                                            <input type="submit" value="Submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('addjs')
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endsection
