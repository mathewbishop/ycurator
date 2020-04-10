$(document).ready(function () {
    var path = window.location.pathname
    $(".main-nav").find(".nav-active").removeClass("nav-active")
    $(".main-nav .nav-link").each(function () {
        if ($(this).attr("href") === path) {
            $(this).addClass("nav-active")
        }
    })
});

