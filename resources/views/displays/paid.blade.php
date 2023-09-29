
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>OSCAR Paid</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/paid.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width,minimum-scale=0, maximum-scale=10">


</head>
<body>
    <header>
        <div class="title">
            <p>有給申請フォーム</p>
        </div>
    </header>
    <div class="main">
        <form action="{{ route('submit-application') }}" method="POST" id="application-form">

            @csrf
            <div class="form-group2">
                <input type="hidden" id="day" name="day" value="">

                <div class="hope">
                    <label for="hope">有給取得希望日</label><br>
                    <input type="text" id="hope" name="hope">
                </div>
                <div class="approver">
                    <label for="approver">決裁者（上長選択）</label><br>
                    <select id="approver" name="approver">
                        <option value="">選択してください</option>
                        @foreach ($approvers as $approverId => $approverName)
                            <option value="{{ $approverId }}">{{ $approverName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="note">
                    <label for="note">備考</label><br>
                    <input type="text" id="note" name="note">
                </div>
            </div>
            <button type="submit" id="submit-button">申請</button>
        </form>
        <a href="/home_general" id="home-move">ホームへ戻る</a>
    </div>


    <script>
        document.getElementById('hope').addEventListener('blur', function () {
            const inputDate = this.value.trim();
            const convertedDate = convertToDatabaseDateFormat(inputDate);
            this.value = convertedDate;
        });

        function convertToDatabaseDateFormat(dateString) {
            const today = new Date();
            const year = today.getFullYear();

            // 日付をMM-DDの形式に変換
            const matches = dateString.match(/(\d+)月(\d+)日/);
            if (matches && matches.length === 3) {
                const month = matches[1].padStart(2, '0');
                const day = matches[2].padStart(2, '0');
                const formattedDate = `${month}-${day}`;

                // 年を追加してYYYY-MM-DDの形式に変換
                return `${year}-${formattedDate}`;
            }

            return dateString;  // マッチしない場合はそのまま返す
        }

    </script>


    <script>
        document.getElementById('submit-button').addEventListener('click', function (event) {
            event.preventDefault();

            const today = new Date();
            const year = today.getFullYear();
            const month = (today.getMonth() + 1).toString().padStart(2, '0');
            const day = today.getDate().toString().padStart(2, '0');

            const formattedDate = `${year}-${month}-${day}`;
            document.getElementById('day').value = formattedDate;

            document.getElementById('application-form').submit();
        });
    </script>









</body>
</html>







