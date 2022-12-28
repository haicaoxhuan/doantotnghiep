{{-- <input type="hidden" value="{{ $product->id }}" class="product_id_{{ $product->id }}">
<input type="hidden" value="{{ $product->name }}" class="product_name_{{ $product->id }}">
<input type="hidden" value="{{ $product->price }}" class="product_price_{{ $product->id }}">
<input type="hidden" value="{{ $product->price_dc }}" class="product_price_dc_{{ $product->id }}">
<input type="hidden" value="{{ $product->images[0] }}" class="product_images_{{ $product->id }}"> --}}
<div class="product-img img-zoom mb-25">
    <a href="{{ route('front.product', ['id' => $product->id]) }}">
        <img src={{ asset($product->images[0]) }}>
    </a>
    <div class="product-action-wrap">
        <button class="product-action-btn-1" title="Wishlist"><i class="pe-7s-like"></i></button>
        <button class="product-action-btn-1 btn-detail" data-product-id="{{ $product->id }}" title="Quick View"
            data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="pe-7s-look"></i>
        </button>
    </div>
    <div class="product-action-2-wrap">
        <button type="button" data-id="{{ $product->id }}" class="product-action-btn-2 btn-detail "
            title="Add To Cart" title="Quick View" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                class="pe-7s-cart"></i>Add to cart</button>
    </div>
</div>
<div class="product-content">
    <h3><a href="{{ route('front.product', ['id' => $product->id]) }}">{{ $product->name }}</a></h3>
    <div class="product-price">
        @if ($product->price_dc != null)
            <span class="old-price"> {{ number_format($product->price) }}đ </span>
            <span class="new-price"> {{ number_format($product->price_dc) }}đ </span>
        @else
            <span> {{ number_format($product->minPrice) }}đ - {{number_format($product->maxPrice) }}đ </span>
        @endif
    </div>
</div>
