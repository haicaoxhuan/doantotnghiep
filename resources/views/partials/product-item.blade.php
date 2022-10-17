<div class="product-img img-zoom mb-25">
    <a href="product-details.html">
        <img src={{ asset('images/' . $product->productImages[0]->images) }}>
    </a>
    <div class="product-action-wrap">
        <button class="product-action-btn-1" title="Wishlist"><i class="pe-7s-like"></i></button>
        <button class="product-action-btn-1 btn-detail" data-product-id="{{ $product->id }}" title="Quick View"
            data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="pe-7s-look"></i>
        </button>
    </div>
    <div class="product-action-2-wrap">
        <button class="product-action-btn-2" title="Add To Cart"><i class="pe-7s-cart"></i>
            Add to cart</button>
    </div>
</div>
<div class="product-content">
    <h3><a href="product-details.html">{{ $product->name }}</a></h3>
    <div class="product-price">
        @if ($product->price_dc != null)
            <span class="old-price"> ${{ $product->price }} </span>
            <span class="new-price"> ${{ $product->price_dc }} </span>
        @else
            <span> ${{ $product->price }} </span>
        @endif
    </div>
</div>
