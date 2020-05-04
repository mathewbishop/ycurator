@extends('layouts.app')

@section('content')

<div class="container">

    <section id="article-list">
        @if(!empty($articles))
        @foreach($articles as $article)
        <div class="article">
            <h1 class="article__title">{{ $article['title'] }}</h1>
            @if(isset($article['descendants']))
            <small class="article__comment-count">Comment Count: {{$article['descendants']}}</small>
            @endif
            <div class="article__link-container">
                @if(isset($article['url']))
                <a href="{{ $article['url'] }}" class="article-link">Read Article</a>
                @endif
                <a href="https://news.ycombinator.com/item?id={{$article['id']}}" class="discussion-link">Read
                    Discussion</a>
            </div>
        </div>
        @endforeach
        @else
        <p class="no-results">No results found.</p>
        @endif
    </section>

</div>

@endsection