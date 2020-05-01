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
                @foreach($articles as $article)
                <div class="article">
                    <h1 class="article__title">{{ $article['title'] }}</h1>
                    <small class="article__comment-count">Comment Count: {{$article['descendants']}}</small>
                    <div class="article__link-container">
                        @if(isset($article['url']))
                        <a href="{{ $article['url'] }}" class="article-link">Read Article</a>
                        @endif
                        <a href="https://news.ycombinator.com/item?id={{$article['id']}}" class="discussion-link">Read Discussion</a>
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