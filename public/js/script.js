function isUserAuthenticated() {
    return userID !== undefined ? true : false
}


function GetCurrentArticles() {
    $(".lds-dual-ring, .loading-overlay").show()

    $.ajax({
        url: "http://ycurator.test/api/current-articles",
        type: "GET",
        dataType: "json",
        data: { userID: userID },
        success: function (res) {
            $(".lds-dual-ring, .loading-overlay").hide()
            console.log(res)
            if (res.length === 0) {
                $("#no-results").show()
            }
            var articleList = $("#article-list")
            articleList.empty()
            res.forEach(function (article, index) {
                // Create Elements
                var articleContainer = $("<div>").addClass("article")
                var title = $("<h1>").attr("id", "title_" + index).addClass("article__title").text(article.title)

                var commentCount = $("<small>").attr("id", "comment-count_" + index).addClass("article__comment-count").data("commentCount", article.descendants).text("Comment Count: " + article.descendants)

                var linkContainer = $("<div>").addClass("article__link-container")

                var articleLink = $("<a>").attr("href", article.url).attr("id", "article-link_" + index).addClass("article-link").text("Read Article")
                var discussionLink = $("<a>").attr("href", `https://news.ycombinator.com/item?id=${article.id}`).attr("id", "disc-link_" + index).addClass("discussion-link").text("Read Discusson")
                var btnSaveArticle = $("<a>").attr({ "id": "btn-save-article_" + index, "href": "#" }).addClass("btn-save-article").text("Save Article")

                // Attach Event Listeners
                btnSaveArticle.on("click", function (e) {
                    e.preventDefault();
                    console.log($("#comment-count_" + index).data("commentCount"))
                    var articleObj = {
                        userID: userID,
                        title: $("#title_" + index).text().trim(),
                        commentCount: $("#comment-count_" + index).data("commentCount"),
                        articleUrl: $("#article-link_" + index).attr("href"),
                        discussionUrl: $("#disc-link_" + index).attr("href")
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
                            console.log(err)
                        }
                    })
                })

                // Final DOM Attachments
                linkContainer.append(articleLink, discussionLink)
                if (isUserAuthenticated()) {
                    linkContainer.append(btnSaveArticle)
                }
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


function GetSavedArticles() {
    $(".lds-dual-ring, .loading-overlay").show()

    $.ajax({
        url: "http://ycurator.test/api/saved-articles",
        type: "GET",
        dataType: "json",
        data: { userID: userID },
        success: function (res) {
            $(".lds-dual-ring, .loading-overlay").hide()
            console.log(res)
            if (res.length === 0) {
                $("#no-results").show()
            }
            var articleList = $("#saved-articles-list")
            articleList.empty()
            res.forEach(function (article, index) {
                // Create Elements
                var articleContainer = $("<div>").addClass("article")
                var title = $("<h1>").attr("id", "title_" + index).addClass("article__title").text(article.title)

                var commentCount = $("<small>").attr("id", "comment-count_" + index).addClass("article__comment-count").data("commentCount", article.comment_count).text("Comment Count: " + article.comment_count)

                var linkContainer = $("<div>").addClass("article__link-container")

                var articleLink = $("<a>").attr("href", article.article_url).attr("id", "article-link_" + index).addClass("article-link").text("Read Article")
                var discussionLink = $("<a>").attr("href", article.discussion_url).attr("id", "disc-link_" + index).addClass("discussion-link").text("Read Discusson")


                // Final DOM Attachments
                linkContainer.append(articleLink, discussionLink)
                articleContainer.append(title, commentCount, linkContainer)

                articleList.append(articleContainer)
            });
        },
        error: function (err) {
            $(".lds-dual-ring, .loading-overlay").hide()
            console.log(err)
        }
    })
}


function GetUserKeywords() {
    $(".lds-dual-ring, .loading-overlay").show()

    $.ajax({
        url: "http://ycurator.test/api/criteria",
        type: "GET",
        dataType: "json",
        data: { userID: userID },
        success: function (res) {
            $(".lds-dual-ring, .loading-overlay").hide()
            console.log(res)
        },
        error: function (err) {
            $(".lds-dual-ring, .loading-overlay").hide()
            console.log(err)
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

    switch (path) {
        case "/":
            GetCurrentArticles();
            break;
        case "/saved-articles":
            GetSavedArticles();
            break;
    }
});

