<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model {
    use HasFactory;

    protected $table = 'applications';

    protected $fillable = ['hope', 'approver_id', 'note', 'status', 'approval_id'];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setApproval($approval)
    {
        $this->approval = $approval;
    }

    public function approver()
    {
        return $this->belongsTo(Approver::class, 'approver_id');
    }

    public function approval()
    {
        return $this->belongsTo(Approval::class, 'approval_id');
    }

}

