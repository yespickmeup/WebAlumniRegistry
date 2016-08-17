<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Registry</title>
    @include('layouts.css')
</head>
<body>

    @if (!Auth::guest())
        @include('layouts.header')
    @endif
    <div class="container">
        @yield('content')
    </div>
    @include('layouts.js')
</body>
</html>