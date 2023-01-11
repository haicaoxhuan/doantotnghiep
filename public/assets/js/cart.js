(function($) {
    var CartPlusMinus = $(".product-quality");
    CartPlusMinus.prepend('<div class="dec qtybutton">-</div>');
    CartPlusMinus.append('<div class="inc qtybutton">+</div>');

    $('.qty').on('input', function() {
        var data = $(this).val();
        data = Number(data.replace(/\D/g, ""));
        var quantity = Number($(this).closest('.product-details-content').find('.qty-detail').text());
        if (data > quantity) {
            data = quantity;
        }
        $(this).val(data);
    })

    $(".qtybutton").on("click", function() {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.text() === "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        $button.parent().find("input").val(newVal);

        updatedCart($(this).closest(".cart-quality"));
        if ($('input[name="coupon_code"]').val().length) {
            addCoupon();
        }
    });

    //coupon
    $(".add-coupon").on("click", function() {
        addCoupon();
    });

    function addCoupon() {
        var coupon = $('input[name="coupon_code"]').val();
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-Token": $('input[name="_token"]').val(),
            },
            url: "/add-coupon",
            data: {
                coupon: coupon,
            },
            success: function(response) {
                var value_code = document.querySelector(".sumCart");
                var value = Number(value_code.innerHTML.replace(/\D/g, ""));
                if (response.status === 200) {
                    var value_coupon = value * (Number(response.data / 100));
                    var total = value - value_coupon;
                    $(".value-coupon").html(VND.format(value_coupon).replaceAll(".", ","));
                    $(".total-coupon").html(VND.format(total).replaceAll(".", ","));
                } else {
                    $(".value-coupon").html("");
                    $(".total-coupon").html(VND.format(value).replaceAll(".", ","));
                    toastr.error(response.msg.text, { timeOut: 5000 });
                }
            },
        });
    }
    const VND = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
    });

    function updatedCart(item) {
        var cart_qty = item.find(".qty").val();
        var cart_pro_id = item.find(".qty").data("id");
        var car_pro_price = item.find(".qty").data("price");
        $.ajax({
            type: "GET",
            url: "cart/update",
            data: { id: cart_pro_id, qty: cart_qty, price: car_pro_price },
            success: function(response) {
                item.closest("tr")
                    .find(".cart-pro-subtotal")
                    .html(VND.format(response.subtotal).replaceAll(".", ","));
                var products = document.querySelectorAll(".cart-pro-subtotal");
                var sum = 0;
                $.each(products, function(index, value) {
                    sum += Number(value.innerHTML.replace(/\D/g, ""));
                });
                $(".sumCart").html(VND.format(sum).replaceAll(".", ","));
                if ($('input[name="coupon_code"]').val().length == 0) {
                    $(".total-coupon").html(VND.format(sum).replaceAll(".", ","));
                }
            },
            error: function(error) {},
        });
    }
    $('.submit-cp').on('click', function() {
        document.getElementById("coupon-cp").submit();
    })
})(jQuery);