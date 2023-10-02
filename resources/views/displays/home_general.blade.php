

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>OSCAR Home</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home_general.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width,minimum-scale=0, maximum-scale=10">
</head>

<body>


    <header>

        <div class="logo">
            <p>OSCAR</p>
        </div>

        <div class="log">
            <div class="logout" id="logout_button">ログアウト</div>
        </div>


    </header>


    <div class="main">
        <div class="situation">

            <h2>勤怠関連</h2>

            <div class="form-group1">

                <div class="button1">
                    <a href="clockin" id="clockin_button">出勤報告</a><br>
                    <a href="clockout" id="clockout_button">退勤報告</a>
                </div>

                <a href="/attendance_general" id="situation_move">勤怠状況一覧</a>

            </div>

        </div>

        <div class="status">

            <h2>申請関連</h2>

            <div class="form-group2">

                <div class="button2">
                    <a href="paid" id="paid_button">有給申請</a><br>
                </div>

                <a href="/application_general" id="status_move">有給申請一覧</a>

            </div>

        </div>
    </div>


    <div id="logoutPopup" class="custom-popup">
        <p>ログアウトしますか？</p>
        <button id="confirmLogout" class="ok-button">OK</button>
        <button id="cancelLogout" class="ok-button">キャンセル</button>
    </div>

    <script>
        // ログアウトボタンクリック時の処理
        document.getElementById('logout_button').addEventListener('click', function() {
            document.getElementById('logoutPopup').style.display = 'block';
        });

        // キャンセルボタンクリック時の処理
        document.getElementById('cancelLogout').addEventListener('click', function() {
            document.getElementById('logoutPopup').style.display = 'none';
        });

        // OKボタンクリック時の処理
        document.getElementById('confirmLogout').addEventListener('click', function() {
            window.location.href = '/';
        });
    </script>



</body>
</html>




