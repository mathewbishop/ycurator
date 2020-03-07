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

        </main>

    </div>

    @include('footer')

    @include('loading')
</body>

</html>