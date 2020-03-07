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
            @foreach ($articles as $article)
            @if(isset($article['descendants']))
            <div class="article-block">
                <h1 class="article-title">{{ $article['title'] }}</h1>
                <small class="article-comment-count">Comment Count: {{$article['descendants']}}</small>
                <div class="article-link-container">
                    <a href="{{$article['url']}}" class="article-link">Read Article</a>
                    <a href="https://news.ycombinator.com/item?id={{$article['id']}}" class="discussion-link">Read
                        Discusson</a>
                </div>
            </div>
            @endif
            @endforeach
        </main>

    </div>

    @include(' footer')
    @include('loading')
</body>

</html>