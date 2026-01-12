$(document).ready(function () {
    let slider = $("#sliderPrice").slider();
    let timer = null;
    let minPrice = $("#minPrice");
    let maxPrice = $("#maxPrice");

    slider.on("change", function (e) {
        clearTimeout(timer);

        timer = setTimeout(function () {
            let min = e.value.newValue[0];
            let max = e.value.newValue[1];

            minPrice.text("$ " + min).css("font-weight", "bold");
            maxPrice.text("$ " + max).css("font-weight", "bold");
            loadProduct(min, max);
        }, 300);
    });

    function loadProduct(min, max) {
        $.ajax({
            url: window.filterPrice,
            method: "POST",
            data: {
                minPrice: min,
                maxPrice: max,
            },
            success: function (res) {
                $("#product-list").html(res);
            },
            error: function (res) {
                console.log(res.responseText);
            },
        });
    }
});
