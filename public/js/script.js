function GetCurrentArticles() {
    $(".lds-dual-ring, .loading-overlay").show()

    $.ajax({
        url: "http://ycurator.test/api/current-articles",
        type: "GET",
        dataType: "json",
        success: function (res) {
            $(".lds-dual-ring, .loading-overlay").hide()
            console.log(res)
            if (res.length === 0) {
                $("#no-results").show()
            }
            var articleList = $("#article-list")
            articleList.empty()
            res.forEach(article => {
                var articleContainer = $("<div>").addClass("article-block")
                var title = $("<p>").addClass("article-title").text(article.title)

                var commentCount = $("<small>").addClass("article-comment-count").text("Comment Count: " + article.descendants)

                var linkContainer = $("<div>").addClass("article-link-container")

                var articleLink = $("<a>").attr("href", article.url).addClass("article-link").text("Read Article")
                var discussionLink = $("<a>").attr("href", `https://news.ycombinator.com/item?id=${article.id}`).addClass("discussion-link").text("Read Discusson")

                linkContainer.append(articleLink, discussionLink)
                articleContainer.append(title, commentCount, linkContainer)

                articleList.append(articleContainer)
            });
        },
        error: function (error) {
            $(".lds-dual-ring, .loading-overlay").hide()
            alert("Error occured, check console.")
            console.log(error)
        }
    })
}


$(document).ready(function () {
    var path = window.location.pathname
    // var url = window.location
    if (path === '/') {
        GetCurrentArticles()
    }
    console.log(window.location.pathname)
    $(".main-nav").find(".nav-active").removeClass("nav-active")
    $(".main-nav .nav-link").each(function () {
        if ($(this).attr("href") === path) {
            $(this).addClass("nav-active")
        }
    })
});

