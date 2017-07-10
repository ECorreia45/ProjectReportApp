$(function () {
    $(".progress h3").on('click', function () {
        $(this).next().slideToggle();
    });

    $("#top_bar div button").on('click', function () {
        $(this).next().toggle();
    });

    $("main > button, .progress div > button").on('click', function () {
        $(this).next().slideToggle();
    });
});
