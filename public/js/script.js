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
                var articleContainer = $("<div>")
                var title = $("<p>").addClass("title is-5").text(article.title)
                var articleLink = $("<a>").attr("href", article.url).addClass("column").text("Read Article")
                var discussionLink = $("<a>").addClass("column").attr("href", `https://news.ycombinator.com/item?id=${article.id}`).text("Read Discusson")
                var linkContainer = $("<div>").addClass("columns")

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

