
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>OSCAR Home</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width,minimum-scale=0, maximum-scale=10">



    <script type="text/javascript">
        function editUser(name) {
            // 名前を編集フォームにセット
            document.getElementById('name').value = name;
            // フォームのアクションを編集用のURLに変更
            document.getElementById('edit-form').action = "/user_edit/" + encodeURIComponent(name);
        }
    </script>
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

    <main>
        <section>
            <h2>社員一覧</h2>
             @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-group">
                <table>
                    <thead>
                        <tr>
                            <th>ユーザID</th>
                            <th>社員コード</th>
                            <th>名前</th>
                            <th>勤怠一覧</th>
                            <th>有給申請</th>
                            <th>編集</th>
                            <th>削除</th>
                            <th>勤怠一覧CSV</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td> 
                                <td>{{ $user->code }}</td>
                                <td>{{ $user->name }}</td>
                                <td><a href="attendance" id="attendance-move">表示</a></td>
                                <td><a href="application" id="application_move">表示</a></td>
                                <td><a href="/user_edit/{{ $user->id }}">編集</a></td>
                                <td><a href="#" onclick="deleteUser('{{ $user->id }}')">削除</a></td>
                                <td><input type="checkbox" class="data-checkbox"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                <div class="button-group">
                    <button id="addition-button" onclick="goToUserEntry()">追加</button>

                    <form action="{{ route('extract.attendance') }}" method="post">
                        @csrf
                        <button type="submit" id="submit-button">抽出</button>
                    </form>
                </div>

            </div>

        </section>

    </main>

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


    
    <script type="text/javascript">
        function goToUserEntry() {
            window.location.href = "/user_entry";
        }
    </script>

    <script type="text/javascript">
        function deleteUser(userId) {
            if (confirm("本当に削除しますか？")) {
                var deleteUrl = "/user_delete/" + userId;

                // フォームを動的に生成して削除リクエストを送信
                var form = document.createElement('form');
                form.setAttribute('method', 'post');
                form.setAttribute('action', deleteUrl);
                form.setAttribute('style', 'display:none');
                form.innerHTML = '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                '<input type="hidden" name="_method" value="DELETE">';
                document.body.appendChild(form);
                form.submit();
            }
        }

    </script>






</body>
</html>





