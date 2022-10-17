<!-- Product Modal start -->
<div class="modal fade quickview-modal-style" id="exampleModal" tabindex="-1" role="dialog">
    @csrf
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" class="close closeModal" data-bs-dismiss="modal" aria-label="Close"><i class=" ti-close "></i></a>
            </div>
            <div class="modal-body">
                <div class="row gx-0">
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="modal-img-wrap" id="productImg">
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-12">
                        <div class="product-details-content quickview-content">
                            <h2 id="productName"></h2>
                            <div class="product-details-price" id="pricePro">
                            </div>
                            <div class="product-details-review">
                                <div class="product-rating ratePro">
                                    
                                </div>
                                <span>( 1 Customer Review )</span>
                            </div>
                            <p id="productDes"></p>
                            <div class="product-details-action-wrap">
                                <div class="product-quality">
                                    <input class="cart-plus-minus-box input-text qty text" name="qtybutton"
                                        value="1">
                                </div>
                                <div class="single-product-cart btn-hover">
                                    <a href="#">Add to cart</a>
                                </div>
                                <div class="single-product-wishlist">
                                    <a title="Wishlist" href="#"><i class="pe-7s-like"></i></a>
                                </div>
                                <div class="single-product-compare">
                                    <a title="Compare" href="#"><i class="pe-7s-shuffle"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Modal end -->
