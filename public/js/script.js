$(document).ready(function () {
    $.ajax({
        url: "http://ycurator.test/api/articles",
        type: "GET",
        dataType: "json",
        success: function (res) {
            console.log(res)
            var articleList = $("#article-list")
            articleList.empty()
            res.forEach(article => {
                var articleContainer = $("<div>").addClass("article-block")
                var title = $("<p>").addClass("article-title").css("margin-bottom", "5px").text(article.title)

                var linkContainer = $("<div>").addClass("article-link-container")

                var articleLink = $("<a>").attr("href", article.url).addClass("article-link").text("Read Article")
                var discussionLink = $("<a>").attr("href", `https://news.ycombinator.com/item?id=${article.id}`).addClass("discussion-link").text("Read Discusson")

                linkContainer.append(articleLink, discussionLink)
                articleContainer.append(title, linkContainer)

                articleList.append(articleContainer)
            });
        },
        error: function (error) {
            alert("Error occured, check console.")
            console.log(error)
        }
    })
});

