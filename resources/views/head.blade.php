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