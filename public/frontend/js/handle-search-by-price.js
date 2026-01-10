$(document).ready(function () {
    let slider = $("#sliderPrice").slider();
    let timer = null;

    slider.on("change", function (e) {
        clearTimeout(timer);

        timer = setTimeout(function () {
            let min = e.value.newValue[0];
            let max = e.value.newValue[1];

            console.log(min, max);
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
