<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ secure_asset('/css/bulma.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('/css/stylesheet.css') }}">
    <script src="{{ secure_asset('/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ secure_asset('/js/main.js') }}"></script>
    <title>Y-Curator</title>
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
        var baseURL = {!! json_encode(url('/')) !!}
    </script>
</head>