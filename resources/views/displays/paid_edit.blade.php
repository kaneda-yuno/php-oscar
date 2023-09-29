
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>OSCAR Paid</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/paid_edit.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width,minimum-scale=0, maximum-scale=10">
</head>

<body>

    <header>
        <div class="title">
            <p>有給申請の編集フォーム</p>
        </div>
    </header>

    <div class="main">
        @if(isset($application))
        <form action="/paid_update/{{ $application->id }}" method="POST">
            @csrf
            @method('POST')

            <!-- フォームの内容 -->
            <div class="form-group1">
                <p>申請内容</p>
            </div>

            <div class="form-group2">
                <div class="status">
                    <label for="status">ステータス</label><br>
                    <select id="status" name="status">
                        <option value="" disabled selected>選択してください</option>
                        <!-- 他のステータスのオプションをここに追加 -->
                        <option value="確認中" @if($application->status === '確認中') selected @endif>確認中</option>
                        <option value="承諾" @if($application->status === '承諾') selected @endif>承諾</option>
                    </select>
                </div>


                <div class="approval">
                    <label for="approval">承認者</label><br>
                    <select id="approval" name="approval_id"> <!-- ここをapproval_idに変更 -->
                        <option value="" disabled selected>選択してください</option>
                        @foreach($approvals as $approverId => $approverName)
                            <option value="{{ $approverId }}" @if($application->approval_id == $approverId) selected @endif>{{ $approverName }}</option> <!-- ここも修正 -->
                        @endforeach
                    </select>
                </div>




            </div>

            <button type="submit" id="button">更新</button>
        </form>
        @endif
        <a href="/home" id="home-move">ホームへ戻る</a>
    </div>

</body>
</html>





