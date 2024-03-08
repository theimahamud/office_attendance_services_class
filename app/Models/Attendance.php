<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['user_id', 'check_in', 'check_out', 'check_in_out_date', 'status', 'deleted_by'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
