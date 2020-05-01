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

</html>