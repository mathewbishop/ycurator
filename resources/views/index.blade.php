<!DOCTYPE html>
<html lang="en">

@include('head')

<body>

    @include('header')

    @if (Auth::check())
    @include('nav')
    @endif

    <div class="container">

        <p class="no-results">No results found.</p>

        <main id="article-list">

        </main>

    </div>

    @include(' footer')
    @include('loading')
</body>

<script>
    console.log(baseURL)
function GetCurrentArticles() {
    $(".lds-dual-ring, .loading-overlay").show()

    $.ajax({
        url: `${baseURL}/api/current-articles`,
        method: "GET",
        dataType: "json",
        data: { userID: userID },
        success: function (res) {
            $(".lds-dual-ring, .loading-overlay").hide()
            console.log(res)
            if (res.length === 0) {
                $(".no-results").show()
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

                // Final DOM Attachments
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

GetCurrentArticles()

</script>

</html>