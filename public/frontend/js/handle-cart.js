$(document).ready(function () {
    $("tbody").on("click", function (e) {
        e.preventDefault();

        const tr = $(e.target.closest("tr"));
        if (!tr.length) return;

        const cartId = tr.data("cart-id");

        if ($(e.target).closest(".cart_quantity_up").length) {
            updateCartQuantity(cartId, "increment", tr);
        }

        if ($(e.target).closest(".cart_quantity_down").length) {
            updateCartQuantity(cartId, "decrement", tr);
        }

        if ($(e.target).closest(".cart_quantity_delete").length) {
            updateCartQuantity(cartId, "delete", tr);
            tr.remove();
        }
    });

    function updateCartQuantity(cartId, action, tr) {
        $.ajax({
            url: `carts/${cartId}`,
            method: "POST",
            data: { action },
            success: function (res) {
                tr.find(".cart_quantity_input").val(res.itemQty);
                tr.find(".cart_total_price").text(res.itemTotal);
                $("#cartQty").text(res.totalQty);
                $("#total").text(res.total);
                // console.log(res.message);
                if (res.message === "Quantity cannot be less than 1") {
                    alert(res.message);
                }
            },
            error: function (error) {
                console.log(error.responseText);
            },
        });
    }
});
