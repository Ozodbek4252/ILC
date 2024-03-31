<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 *
 * @property int $id
 * @property int $icon_id
 * @property string $number
 * @property string $icon_path
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Icon $icon
 * @property Translation[]|Collection $translations
 */
class Counter extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon_id',
        'number',
    ];

    public function icon()
    {
        return $this->belongsTo(Icon::class);
    }

    public function getIconPathAttribute()
    {
        return $this->icon->icon;
    }

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }
}
