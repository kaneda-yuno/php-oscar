<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model {
    use HasFactory;

    // 出勤用のフィールド
    protected $fillableForClockIn = ['clockin', 'attendance_date', 'location_id', 'note'];

    // 退勤用のフィールド
    protected $fillableForClockOut = ['clockout', 'break_time', 'work_time'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public $timestamps = false;

    /**
     * Save clock in attendance
     *
     * @param array $attributes
     * @return Attendance
     */
    public static function saveClockInAttendance($attributes)
    {
        $attendance = new self($attributes);
        $attendance->fill($attributes->only($this->fillableForClockIn));
        $attendance->save();

        return $attendance;
    }

    /**
     * Save clock out attendance
     *
     * @param array $attributes
     * @return Attendance
     */
    public static function saveClockOutAttendance($attributes)
    {
        $attendance = new self($attributes);
        $attendance->fill($attributes->only($this->fillableForClockOut));
        $attendance->save();

        return $attendance;
    }
    
    public function location() {
        return $this->belongsTo(Location::class, 'location_id');
    }


    public function index() {
        session(['previous_page' => url()->current()]);

        // 他の処理

        return view('home'); // この部分は適宜修正してください
    }
    
}
