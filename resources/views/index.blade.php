<!DOCTYPE html>
<html lang="en">

@include('head')

<body>

    @include('header')

    @if (Auth::check())
    @include('nav')
    @endif

    <div class="container">

        <main id="article-list">
            @if(!empty($articles))
                @foreach($articles as $key => $article)
                <div class="article">
                    <h1 id="title_{{$key}}" class="article__title">{{ $article['title'] }}</h1>
                    <small id="comment-count_{{$key}}" class="article__comment-count">Comment Count: {{$article['descendants']}}</small>
                    <div class="article__link-container">
                        <a href="{{$article['url']}}" id="article_link_{{$key}}" class="article-link">Read Article</a>
                        <a href="https://news.ycombinator.com/item?id={{$article['id']}}" id="disc_link_{{$key}}" class="discussion-link">Read Discussion</a>
                    </div>
                </div>
                @endforeach
            @else
            <p class="no-results">No results found.</p>
            @endif
        </main>

    </div>

    @include(' footer')
    @include('loading')
</body>

<!-- <script>
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
        error: function (err) {
            $(".lds-dual-ring, .loading-overlay").hide()
            alert(`An error occurred. HTTP status: ${err.status}. Error reads: ${err.statusText}`)
            console.log(err)
        }
    })
}

GetCurrentArticles()

</script> -->

</html>