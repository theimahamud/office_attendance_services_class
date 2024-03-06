<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Holiday extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Notifiable;

    protected $fillable = ['title', 'start_date', 'end_date', 'status', 'description'];

    public const PLACEHOLDER_IMAGE_PATH = 'assets/admin/dist/img/placeholder.jpeg';

    public function getImageUrlAttribute(): string
    {
        return $this->hasMedia() ? $this->getFirstMediaUrl() : self::PLACEHOLDER_IMAGE_PATH;
    }
}
