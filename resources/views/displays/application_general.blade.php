
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>OSCAR Application</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/application_general.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width,minimum-scale=0, maximum-scale=10">
</head>

<body>
    <header>
        <div class="title">
            <p>有給申請一覧</p>
        </div>
    </header>

    <div class="main">
        <table>
            <thead>
                <tr>
                    <th>申請日</th>
                    <th>有給取得希望日</th>
                    <th>決裁者</th>
                    <th>備考</th>
                    <th>ステータス</th>
                    <th>承認者</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $application)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($application->day)->format('m月d日') }}</td>
                    <td>{{ \Carbon\Carbon::parse($application->hope)->format('m月d日') }}</td>
                    <td>{{ $application->approver ? $application->approver->name : '' }}</td>
                    <td>{{ $application->note }}</td>
                    <td>{{ $application->status }}</td>
                    <td>{{ $application->approval ? $application->approval->name : '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="/home_general" id="home-move">ホームへ戻る</a>
    </div>
</body>
</html>





