<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = ['key','value'];

    public static function get($key)
    {
        $value = static::where('key', $key)->pluck('value')->first();
        return $value  ?? null;
    }

    public static function set($key = null,$value=null)
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

}
