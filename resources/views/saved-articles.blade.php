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

        <main id="saved-articles-list">

        </main>

    </div>

    @include('footer')

    @include('loading')
</body>

</html>