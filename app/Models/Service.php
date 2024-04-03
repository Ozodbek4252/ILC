<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $link
 * @property string $image
 * @property string $image_url
 * @property int $icon_id
 * @property int $secondary_icon_id
 * @property string $icon_path
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Translation[]|Collection $translations
 * @property Icon $icon
 * @property Icon $secondaryIcon
 */
class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'link', 'icon_id', 'secondary_icon_id', 'image'
    ];

    public function icon(): BelongsTo
    {
        return $this->belongsTo(Icon::class);
    }

    public function secondaryIcon(): BelongsTo
    {
        return $this->belongsTo(Icon::class);
    }

    public function getIconPathAttribute(): string
    {
        return $this->icon->icon;
    }

    public function getSecondaryIconPathAttribute(): string
    {
        return $this->secondaryIcon->icon;
    }

    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image);
    }

    public function translations(): MorphMany
    {
        return $this->morphMany(Translation::class, 'translationable');
    }
}
