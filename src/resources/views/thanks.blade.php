<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
</head>

<body>
    <main>
        <h1>Thank you</h1>
        <h2>お問い合わせありがとうございました</h2>
        <div class="contact-form__content">
            <form action="/index" method="post">
            @csrf
                <div class="form-group">
                    <button type="submit" class="submit-btn">HOME</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>