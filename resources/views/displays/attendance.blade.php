
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>OSCAR Attendance</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/attendance.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width,minimum-scale=0, maximum-scale=10">
</head>

<body>

<header>
    <div class="title">
        <p>勤怠状況一覧</p>
    </div>
</header>

<table id="attendanceTable">
    <thead>
        <div class="month">
            <p>2023年9月</p>
        </div>
        <tr>
            <th>日</th>
            <th>出勤時刻</th>
            <th>退勤時刻</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
            <th>ロケーション</th>
            <th>備考</th>
        </tr>
    </thead>
    <tbody>
        @foreach($attendances as $attendance)
            <tr>
                <td>{{ \Carbon\Carbon::parse($attendance->clockin)->format('d') }}日</td>
                <td>{{ \Carbon\Carbon::parse($attendance->clockin)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($attendance->clockout)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($attendance->break_time)->format('H:i') }}</td>
                <td>{{ date('H:i', strtotime($attendance->work_time)) }}</td>
                <td>
                    @if ($attendance->location)
                        {{ $attendance->location->name }}
                    @else
                        No location
                    @endif
                </td>
                <td>{{ $attendance->note }}</td>
            </tr>
        @endforeach
    </tbody>
</table>



<div class="main">
    <a id="home-move" onclick="redirectToHome()">ホームへ戻る</a>
</div>




<script>
    function redirectToHome() {
        window.location.href = '/home';
    }
</script>



<script>
    


    function exportTableToCSV() {
        var csv = [];
        var rows = document.querySelectorAll('table tr');

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll('td, th');

            for (var j = 0; j < cols.length; j++)
                row.push('"' + cols[j].innerText + '"');

            csv.push(row.join(','));
        }

        downloadCSV(csv.join('\n'), 'attendance.csv');
    }

    function downloadCSV(csv, filename) {
        var csvFile;
        var downloadLink;

        // CSVデータをUTF-8でエンコード
        var csvData = new Blob([new Uint8Array([0xEF, 0xBB, 0xBF]), csv], { type: 'text/csv;charset=UTF-8' });

        // ダウンロードリンクを作成
        downloadLink = document.createElement('a');

        // ダウンロードリンクの属性を設定
        downloadLink.download = filename;
        downloadLink.href = window.URL.createObjectURL(csvData);
        downloadLink.style.display = 'none';

        // MIMEタイプを指定
        downloadLink.dataset.downloadurl = ['text/csv;charset=UTF-8', downloadLink.download, downloadLink.href].join(':');

        // ダウンロードリンクをHTMLに追加
        document.body.appendChild(downloadLink);

        // ダウンロードリンクをクリック
        downloadLink.click();

        // ダウンロードリンクの削除
        document.body.removeChild(downloadLink);
    }

</script>






</body>
</html>





