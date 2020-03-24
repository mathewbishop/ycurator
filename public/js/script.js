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
            res.forEach((article, index) => {
                var articleContainer = $("<div>").addClass("article")
                var title = $("<h1>").attr("id", "title_" + index).addClass("article__title").text(article.title)

                var commentCount = $("<small>").attr("id", "comment-count_" + index).addClass("article__comment-count").text("Comment Count: " + article.descendants)

                var linkContainer = $("<div>").addClass("article__link-container")

                var articleLink = $("<a>").attr("href", article.url).attr("id", "article-link_" + index).addClass("article-link").text("Read Article")
                var discussionLink = $("<a>").attr("href", `https://news.ycombinator.com/item?id=${article.id}`).attr("id", "disc-link_" + index).addClass("discussion-link").text("Read Discusson")

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
            url: "http://ycurator.test/save-article",
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

    // Get articles on page load
    GetCurrentArticles();
});

