
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>OSCAR Clockout</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/clockout.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width,minimum-scale=0, maximum-scale=10">
</head>

<body>
    <header>
        <div class="title">
            <p>退勤報告フォーム</p>
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
                    <div class="break">休憩時間</div>
                </div>

                <div class="form-group2">
                    <div class="input-group">
                        <input type="text" id="break" name="break"><br>
                    </div>
                </div>
            </section>

            <button type="submit" id="button">退勤</button>

        </form>

        <div class="note">※退勤後ただちに退勤処理を行ってください</div>

        <a href="/home_general" id="home-move">ホームへ戻る</a>
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


    <script>
        // JavaScriptで時間を「時間:分」の形式に変換
        function formatToHoursAndMinutes(hours, minutes) {
            return hours + '時間' + minutes + '分';
        }

        // JavaScriptで「時間:分」を分単位に変換
        function convertToMinutes(timeString) {
            const [hours, minutes] = timeString.split(':').map(Number);
            return (hours * 60) + minutes;
        }

        // フォームが送信される際の処理
        document.querySelector('form').addEventListener('submit', function(event) {
            const breakInput = document.getElementById('break');
            const breakValue = breakInput.value.trim();

            // 時間を分単位に変換
            const breakMinutes = convertToMinutes(breakValue);

            // 変換した値をフォームにセット
            breakInput.value = formatToHoursAndMinutes(Math.floor(breakMinutes / 60), breakMinutes % 60);
        });
    </script>


</body>
</html>


