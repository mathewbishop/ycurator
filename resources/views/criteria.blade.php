<!DOCTYPE html>
<html lang="en">

@include('head')

<body>

    @include('header')

    @if (Auth::check())
    @include('nav')
    @endif

    <div class="container">

        <p class="no-results">You have not added any keywords.</p>

        <main>
            <ul id="keywords-list">

            </ul>
        </main>

    </div>

    @include('footer')

    @include('loading')
</body>

</html>