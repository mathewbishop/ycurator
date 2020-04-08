<header class="site-header">
    <div>
        <h1 class="site-title is-size-3">Y-Curator</h1>
        <p class="site-subtitle">Curated articles from <a href="https://news.ycombinator.com/news">Hacker News.</a></p>
        @if (Auth::check())
        <p><em>Articles are curated from the current top 25 stories.</em></p>
        @else
        <p><em>Displaying top 25 stories. Login to get curated results.</em></p>
        @endif
    </div>
    <div>
        @if (Auth::check())
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" class="button btn-login">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @else
        <a href="/login" class="button btn-login">Login</a>
        @endif
    </div>
</header>