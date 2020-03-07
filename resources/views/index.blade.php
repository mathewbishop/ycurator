<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/bulma.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/stylesheet.css') }}">
    <script src="{{ asset('/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
    <title>Y-Curator</title>
</head>

<body>

    @include('header')

    @if (Auth::check())
    @include('nav')
    @endif

    <div class="container">

        <main>
            @if (!empty($articles))
            @foreach ($articles as $key => $article)
            @if(isset($article['descendants']))
            <div class="article-block">
                <h1 id="title_{{$key}}" class="article-title">{{ $article['title'] }}</h1>
                <small id="comment-count_{{$key}}" class="article-comment-count"
                    data-comment-count="{{$article['descendants']}}">Comment Count:
                    {{$article['descendants']}}</small>
                <div class="article-link-container">
                    <a id="article-link_{{$key}}" href="{{$article['url']}}" class="article-link">Read Article</a>
                    <a id="disc-link_{{$key}}" href="https://news.ycombinator.com/item?id={{$article['id']}}"
                        class="discussion-link">Read
                        Discusson</a>
                    @if (Auth::check())
                    <a id="btn-save-article_{{$key}}" href="#" class="btn-save-article">Save Article</a>
                    @endif
                </div>
            </div>
            @endif
            @endforeach
            @else
            <p class="no-results">No articles that meet the curation criteria were found.</p>
            @endif
        </main>

    </div>

    @include(' footer')
    @include('loading')
</body>

</html>