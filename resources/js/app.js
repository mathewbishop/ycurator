window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.$ = window.jQuery = require('jquery');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

$(document).ready(function () {
    var path = window.location.pathname
    $(".main-nav").find(".nav-active").removeClass("nav-active")
    $(".main-nav .nav-link").each(function () {
        if ($(this).attr("href") === path) {
            $(this).addClass("nav-active")
        }
    })
});

