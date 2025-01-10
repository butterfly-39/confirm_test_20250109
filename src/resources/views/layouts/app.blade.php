<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="header__title">FashionablyLate</h1>
            @yield('button')
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>