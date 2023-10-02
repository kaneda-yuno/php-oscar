<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;
use App\Models\Approver;
use App\Models\Application;
use App\Models\Approval;
use App\Models\Attendance;
use Illuminate\Support\Facades\Redirect;


use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;

class OscarController extends Controller {

    //ログイン画面
    public function login(Request $request) {
        // リクエストからコードとパスワードを取得
        $code = $request->input('code');
        $password = $request->input('password');
        
        // ユーザーをデータベースから取得
        $user = User::where('code', $code)->first();

        // ユーザーが存在し、パスワードが正しい場合
        if ($user && $user->password === $password) {
            // authorityに応じてリダイレクト先を変える
            if ($user->authority === 0) {
                return redirect()->route('displays/home');
            } elseif ($user->authority === 1) {
                return redirect()->route('displays/home_general');
            }
        }

        return redirect()->route('displays/portal')->with('error', '社員コードまたはパスワードが違います。');

    }
    //ログイン画面
    public function portal() {
        return view('displays.portal');
    }
    //社員一覧
    public function index() {
        $users = User::where('authority', 1)->select('id', 'code', 'name')->get();
    
        return view('displays.home', ['users' => $users]);
    }
    
    //社員編集
    public function edit($id) {
        $user = User::find($id);
        return view('displays.user_edit', ['user' => $user]);
    }
    public function update(Request $request, $id) {

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->save();
    
        return redirect()->route('displays/home');
    }
    //社員追加登録
    public function showUserEntryForm() {
        return view('user_entry');
    }
    public function registerUser(Request $request) {

        // リクエストからユーザ情報を取得
        $code = $request->input('code');
        $passwordHash = bcrypt($request->input('password'));
        $name = $request->input('name');

        // 新しいユーザを作成
        $user = new User();
        $user->code = $code;
        $user->password = $passwordHash;
        $user->name = $name;
        $user->authority = 1;

        // ユーザを保存
        $user->save();

        // ユーザ登録が成功したらホーム画面にリダイレクト
        return redirect()->route('displays/home');
    }

    //社員削除
    public function deleteUser($id) {
        $user = User::findOrFail($id); // ユーザを取得
        $user->delete(); // ユーザを削除
    
        return redirect()->route('displays/home');
    }

    //ロケーションプルダウン
    public function showClockinForm() {
        $locations = Location::pluck('name', 'id');
        return view('displays.clockin', compact('locations'));
    }

    //決裁者プルダウン
    public function showPaidForm() {
        $approvers = Approver::pluck('name', 'id');
        return view('displays.paid', compact('approvers'));
    }
    
    //有給申請    
    public function submitApplication(Request $request) {
        // リクエストからデータを取得
        $hope = $request->input('hope');
        $approver = $request->input('approver');
        $note = $request->input('note');
    
        // 日付を取得
        $day = $request->input('day');
    
        // Applicationモデルを使ってデータベースに格納
        $application = new Application();
        $application->hope = $hope;
        $application->approver_id = $approver;
        $application->note = $note;
        $application->day = $day;  // 日付を設定
        $application->save();
        
        //ホーム画面にリダイレクト
        return redirect('/application_general');
    }
    public function showApplications() {
        $applications = Application::all();
        
        return view('displays.application_general', compact('applications'));
    }
    public function showApplicationsForAnotherUrl() {
        $applications = Application::all();
        
        return view('displays.application', compact('applications'));
    }
    
    
    //承認者プルダウン
    public function paidedit($id) {
        $application = Application::find($id);
        $approvals = Approval::pluck('name', 'id');
    
        return view('displays.paid_edit', compact('application', 'approvals'));
    }

    // 有給申請を更新    
    public function paidupdate(Request $request, $id) {
        // リクエストからステータスと承認者を取得
        $status = $request->input('status');

        // 承認者のIDを取得
        $approval_id = $request->input('approval_id');
        
        // 該当の申請を取得し、更新
        $application = Application::find($id);
        $application->status = $status;

        // 承認者のIDを格納
        $application->approval_id = $approval_id;
        $application->save();

        // 適切なリダイレクト先にリダイレクト
        return redirect()->route('displays.application');
    }
    
 

    public function store(Request $request) {
        // 出勤日時を取得
        $attendanceDateTime = now();
    
        // 日付のみを取得
        $date = now()->toDateString();
    
        // ユーザーが選択したロケーションIDを取得
        $locationId = $request->input('location_id');
    
        // 休憩時間を取得
        $breakTimeInput = $request->input('break');
    
        // 休憩時間を「00:00」形式に変換
        $breakTime = $this->convertToTimeFormat($breakTimeInput);
    
        // 休憩時間を分単位に変換
        $breakMinutes = $this->convertToMinutes($breakTimeInput);
    
        // 同じ日付のレコードが存在するかチェック
        $existingRecord = Attendance::where('clockin', '>=', $date . ' 00:00:00')
                                    ->where('clockin', '<=', $date . ' 23:59:59')
                                    ->first();
    
        if ($existingRecord) {
            // 日付が同じ場合、既存のレコードを更新
            $existingRecord->clockout = $attendanceDateTime;
            $existingRecord->break_time = $breakTime;
    
            // 勤務時間を計算
            $workMinutes = ($attendanceDateTime->diffInMinutes($existingRecord->clockin)) - $breakMinutes;
    
            // 勤務時間を時間と分に分解
            $hours = floor($workMinutes / 60);
            $minutes = $workMinutes % 60;
    
            // 1桁の場合は0を付加して2桁にする
            $hoursFormatted = str_pad($hours, 2, '0', STR_PAD_LEFT);
            $minutesFormatted = str_pad($minutes, 2, '0', STR_PAD_LEFT);
    
            // 勤務時間を「00:00」の形式にする
            $workTime = "{$hoursFormatted}:{$minutesFormatted}";
    
            // 00:00 形式で格納
            $existingRecord->work_time = $workTime;
            $existingRecord->save();
        } else {
            // 日付が異なる場合、新しいレコードを作成
            $attendance = new Attendance();
            $attendance->clockin = $attendanceDateTime;
            $attendance->clockout = $attendanceDateTime;
            $attendance->location_id = $locationId;
            $attendance->break_time = $breakTime;
    
            // 勤務時間を計算
            $workMinutes = ($attendanceDateTime->diffInMinutes($attendanceDateTime)) - $breakMinutes;
    
            // 勤務時間を時間と分に分解
            $hours = floor($workMinutes / 60);
            $minutes = $workMinutes % 60;
    
            // 1桁の場合は0を付加して2桁にする
            $hoursFormatted = str_pad($hours, 2, '0', STR_PAD_LEFT);
            $minutesFormatted = str_pad($minutes, 2, '0', STR_PAD_LEFT);
    
            // 勤務時間を「00:00」の形式にする
            $workTime = "{$hoursFormatted}:{$minutesFormatted}";
    
            // 00:00 形式で格納
            $attendance->work_time = $workTime;
    
            $attendance->save();
        }
    
        return redirect('/home_general');
    }
    



    //休憩時間を「00:00」形式に変換
    private function convertToTimeFormat($breakTimeInput) {
        // 休憩時間が「00:00」形式でない場合は変換を試みる
        if (!preg_match('/^\d{1,2}:\d{2}$/', $breakTimeInput)) {
            $breakMinutes = $this->convertToMinutes($breakTimeInput);
            $hours = floor($breakMinutes / 60);
            $minutes = $breakMinutes % 60;
            return sprintf("%02d:%02d", $hours, $minutes);
        }
        return $breakTimeInput; // すでに「00:00」形式の場合はそのまま返す
    }

    private function convertToMinutes($timeString) {
        // 時間が文字列の場合、「時間:分」の形式に変換
        if (strpos($timeString, '時間') !== false) {
            $timeParts = explode('時間', $timeString);
            $hours = (int)$timeParts[0];
            $minutes = 0;
            if (isset($timeParts[1])) {
                $minutesPart = trim($timeParts[1]);
                if (!empty($minutesPart)) {
                    $minutes = (int)$minutesPart;
                }
            }
            return $hours * 60 + $minutes;
        } else {
            // 文字列以外の場合はそのまま返す
            return (int)$timeString;
        }
    }

    public function showAttendanceList() {
        $attendances = Attendance::all();
        return view('displays.attendance', compact('attendances'));
    }
        public function AttendanceList() {
        $attendances = Attendance::all();
        return view('displays.attendance_general', compact('attendances'));
    }
    
    

    //csv抽出
    public function extractAttendance()
    {
        $attendances = Attendance::all();  // YourModel は実際のモデル名に置き換えてください

        $csvData = [];
        $csvData[] = ['日', '出勤時刻', '退勤時刻', '休憩時間', '勤務時間', 'ロケーション', '備考'];

        foreach ($attendances as $attendance) {
            $rowData = [
                \Carbon\Carbon::parse($attendance->clockin)->format('d') . '日',
                \Carbon\Carbon::parse($attendance->clockin)->format('H:i'),
                \Carbon\Carbon::parse($attendance->clockout)->format('H:i'),
                \Carbon\Carbon::parse($attendance->break_time)->format('H:i'),
                date('H:i', strtotime($attendance->work_time)),
                $attendance->location ? $attendance->location->name : 'No location',
                $attendance->note
            ];

            $csvData[] = $rowData;
        }

        $outputCsv = Writer::createFromString('');
        $outputCsv->insertAll($csvData);

        $csvContent = $outputCsv->getContent();

        return response()->streamDownload(function () use ($csvContent) {
            echo $csvContent;
        }, 'attendance.csv');

        
    }
    

    



}







