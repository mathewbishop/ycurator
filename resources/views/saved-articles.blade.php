<!DOCTYPE html>
<html lang="en">

@include('head')

<body>

    @include('header')

    @if (Auth::check())
    @include('nav')
    @endif

    <div class="container">

        <main>

        </main>

    </div>

    @include('footer')

    @include('loading')
</body>

</html>