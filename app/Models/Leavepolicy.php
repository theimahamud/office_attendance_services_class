<?php

namespace App\Models;

use App\Constants\LeaveStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leavepolicy extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'start_date', 'end_date', 'status', 'maximum_in_year', 'description'];

    public function leaveRequest()
    {
        return $this->hasMany(LeaveRequest::class,'leave_policy_id','id')->where('status',LeaveStatus::APPROVED);
    }
}
