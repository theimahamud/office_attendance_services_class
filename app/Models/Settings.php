<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Settings extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['key','value'];

    public const PLACEHOLDER_IMAGE_PATH = 'assets/admin/dist/img/placeholder.jpeg';

    public function getImageUrlAttribute(): string
    {
        return $this->hasMedia() ? $this->getFirstMediaUrl('company_logo') : self::PLACEHOLDER_IMAGE_PATH;
    }

    public static function get($key)
    {
        $value = static::where('key', $key)->pluck('value')->first();
        return $value  ?? null;
    }

    public static function set($key = null,$value=null)
    {
       return static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

}
