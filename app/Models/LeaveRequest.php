<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class LeaveRequest extends Model
{
    use HasFactory, SoftDeletes , Notifiable;

    protected $fillable = [
        'user_id',
        'referred_by',
        'leave_policy_id',
        'start_date',
        'end_date',
        'days',
        'leave_reason',
        'status',
        'comment',
        'deleted_by',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function referredBy()
    {
        return $this->belongsTo(User::class, 'referred_by', 'id');
    }

    public function leavePolicy()
    {
        return $this->belongsTo(Leavepolicy::class);
    }
}
