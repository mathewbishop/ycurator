window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */


window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


document.addEventListener("DOMContentLoaded", () => {
    const path = window.location.pathname
    const navActive = document.querySelectorAll(".main-nav .nav-active")
    if (navActive.length) {
        navActive[0].classList.remove("nav-active")
        document.querySelectorAll(".main-nav .nav-link").forEach(el => {
            if (el.getAttribute("href") === path) {
                el.classList.add("nav-active")
            }
        })
    }
})
