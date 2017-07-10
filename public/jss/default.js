$(function () {
    var $menubtn = $("#menu_btn");

    $menubtn.on('click',function () {
        $('nav').animate({
            width: "toggle"
        })
    })
});