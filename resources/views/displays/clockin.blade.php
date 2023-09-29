

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>OSCAR Clockin</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/clockin.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width,minimum-scale=0, maximum-scale=10">
</head>

<body>
    <header>
        <div class="title">
            <p>出勤報告フォーム</p>
        </div>
    </header>

    <div class="time">
        <h1 id="current-time">
            <!-- 時刻はここに表示 -->
        </h1>
    </div>

    <div class="main">
        <form action="{{ route('attendance.store') }}" method="POST">
            @csrf
            <section>
                <div class="form-group1">
                    <div class="location">ロケーション</div>

                    <div class="note">備考</div>
                </div>

                <div class="form-group2">
                    <div class="input-group">
                        <select id="location" name="location_id">
                            <option value="">選択してください</option>
                            @foreach ($locations as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select><br>

                        <input type="text" id="note" name="note">
                    </div>
                </div>
            </section>

            <button type="submit" id="button">出勤</button>

            <div class="memo">※勤務開始予定時刻を超えての打刻は禁止です</div>

            <a href="/home_general" id="home-move">ホームへ戻る</a>

        </form>
    </div>

    <script>
        // ページ読み込み後に現在時刻を表示する関数
        function displayCurrentTime() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');

            // ページ内の特定の要素に時刻を挿入
            const timeElement = document.getElementById('current-time');
            timeElement.innerHTML = `${year}年${month}月${day}日<br>${hours}:${minutes}`;
        }

        // ページ読み込み時に現在時刻を表示
        displayCurrentTime();

        // 1分ごとに現在時刻を更新
        setInterval(displayCurrentTime, 60000);
    </script>
</body>
</html>


