<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Y-Curator</title>
    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ secure_asset('/js/app.js') }}"></script>

    @if(Auth::check())
    <script>
        var userID = "{{ Auth::id() }}";
    </script>
    @else
    <script>
        var userID = undefined;
    </script>
    @endif
    <script type="text/javascript">
        var baseURL = {!! json_encode(url('/'))!!}
    </script>
</head>

<body>
    <div id="app">
        <header class="site-header">
            <div>
                <h1 class="is-size-3">Y-Curator</h1>
                <p>Curated articles from <a href="https://news.ycombinator.com/news">Hacker
                        News.</a></p>
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

        @if (Auth::check())
        <nav class="main-nav">
            <a class="button nav-link nav-active" href="/">Articles</a>
            <a class="button nav-link" href="/criteria">Curation Criteria</a>
        </nav>
        @endif

        <main>
            @yield('content')
        </main>

        <footer class="site-footer">
            <p style="color:#263d42;font-weight:700;">Y-Curator</p>
            <small style="color:#263d42;font-weight:700;" class="is-block">A curator for Hacker News articles.</small>
            <small style="color:#263d42;font-weight:700;" class="is-block">Built by <a class="by-line-link"
                    href="https://github.com/mathewbishop">Mathew
                    Bishop</a></small>
        </footer>
    </div>
</body>

</html>