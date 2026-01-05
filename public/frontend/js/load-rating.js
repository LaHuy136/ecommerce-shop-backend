$(".rate").each(function () {
    let avgRating = Math.round($(this).data("rate"));
    $(this)
        .find(".ratings_stars")
        .each(function (index) {
            if ($(this).data("value") < avgRating) {
                $(this).addClass("ratings_over");
            }
        });
});
