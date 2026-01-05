$(".ratings_stars").hover(
    function () {
        $(this).prevAll().addBack().addClass("ratings_hover");
        $(this).nextAll().removeClass("ratings_hover");
    },
    function () {
        $(this).siblings().addBack().removeClass("ratings_hover");
    }
);

$(".ratings_stars").on("click", function () {
    if (!window.isLoggedIn) {
        alert("Please login to rate post");
        return;
    }

    let rating = $(this).data("value");
    let rateBox = $(this).closest(".rate");

    if (rateBox.data("user-rate")) {
        alert("You rated this post");
        return;
    }

    rateBox.find(".ratings_stars").removeClass("ratings_over");
    $(this).prevAll().addBack().addClass("ratings_over");

    $.ajax({
        url: window.rateUrl,
        method: "POST",
        data: {
            rating: rating,
            blog_id: rateBox.data("blog"),
        },
        success: function (res) {
            // rateBox.find(".count").text("(" + res.count + ")");

            // rateBox.find(".avg").text(parseFloat(res.avg).toFixed(1));

            rateBox.attr("data-user-rate", rating);

            alert(res.message);
        },
        error: function (error) {
            console.log(error.responseText);
        },
    });
});
