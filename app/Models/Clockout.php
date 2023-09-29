<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clockout extends Model
{
    use HasFactory;

    protected $fillable = ['clockin', 'clockout', 'break_time', 'work_time'];

    public $timestamps = false;

}
