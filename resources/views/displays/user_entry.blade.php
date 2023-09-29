
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>OSCAR User</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/user_entry.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width,minimum-scale=0, maximum-scale=10">
</head>
<body>
    <header>
        <div class="title">
            <p>追加登録フォーム</p>
        </div>
    </header>
    <div class="main">
        <section>
            <form action="{{ route('register_user') }}" method="POST">
                @csrf
                <div class="form-group1">
                    <p>追加登録</p>
                </div>

                <div class="form-group2">
                    <div class="code">
                        <label for="code">社員コード</label><br>
                        <input type="text" id="code" name="code">
                    </div>
                    <div class="password">
                        <label for="password">パスワード</label><br>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="name">
                        <label for="name">名前</label><br>
                        <input type="text" id="name" name="name">
                    </div>
                </div>
                <button type="submit">登録</button>
            </form>
        </section>
        <a href="/home" id="home-move">ホームへ戻る</a>
    </div>
</body>
</html>



