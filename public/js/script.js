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

                var articleBlock = $("<p>")
                var articleLink = $("<a>").attr("href", article.url).text("Read Article")

                var discussionBlock = $("<p>").css("margin-left", "20px")
                var discussionLink = $("<a>").attr("href", `https://news.ycombinator.com/item?id=${article.id}`).text("Read Discusson")

                articleBlock.append(articleLink)
                discussionBlock.append(discussionLink)

                linkContainer.append(articleBlock, discussionBlock)
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

