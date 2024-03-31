<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $link
 * @property string $image
 * @property string $image_url
 * @property int $icon_id
 * @property string $icon_path
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Translation[]|Collection $translations
 */
class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'link', 'icon_id', 'image'
    ];

    public function icon()
    {
        return $this->belongsTo(Icon::class);
    }

    public function getIconPathAttribute()
    {
        return $this->icon->icon;
    }

    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image);
    }

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }
}
