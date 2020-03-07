$(document).ready(function () {
    var path = window.location.pathname
    $(".main-nav").find(".nav-active").removeClass("nav-active")
    $(".main-nav .nav-link").each(function () {
        if ($(this).attr("href") === path) {
            $(this).addClass("nav-active")
        }
    })

    $(".btn-save-article").on("click", function (e) {
        e.preventDefault();
        var articleIndex = $(this).attr("id").split("_")[1]
        var articleObj = {
            title: $("#title_" + articleIndex).text().trim(),
            commentCount: $("#comment-count_" + articleIndex).attr("data-comment-count"),
            articleUrl: $("#article-link_" + articleIndex).attr("href"),
            discussionUrl: $("#disc-link_" + articleIndex).attr("href")
        }

        $.ajax({
            type: "POST",
            url: "http://ycurator.test/api/save-article",
            data: articleObj,
            dataType: "application/json",
            success: function (res) {
                console.log(res)
            },
            error: function (err) {
                alert("An error has occured. Check console.")
                console.log(err)
            }
        })

    })
});

