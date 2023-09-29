

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>OSCAR Portal</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/portal.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width,minimum-scale=0, maximum-scale=10">
</head>

<body>
    <h1 class="title">OSCAR Portal</h1>
    
    @if(session('error'))
        <div class="error-message">
            {{ session('error') }}
        </div>
    @endif

    <div class="login">
        <form action="{{ route('displays/login') }}" method="POST">

            @csrf
            <div class="form-group1">
                <div class="code">社員コード</div>
                <div class="password">パスワード</div>
            </div>

            <div class="form-group2">
                <div class="input-group">
                    <input type="text" name="code" value="root">
                    <input type="password" name="password" value="kyu11077">
                </div>

                <button type="submit" id="login-button">ログイン</button>
            </div>
        </form>
    </div>

</body>
</html>

