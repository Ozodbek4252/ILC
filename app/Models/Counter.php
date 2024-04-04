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
 * @property int $icon_id
 * @property int $secondary_icon_id
 * @property string $number
 * @property string $icon_path
 * @property string $secondary_icon_path
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Icon $icon
 * @property Icon $secondaryIcon
 * @property Translation[]|Collection $translations
 */
class Counter extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon_id',
        'secondary_icon_id',
        'number',
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

    public function translations(): MorphMany
    {
        return $this->morphMany(Translation::class, 'translationable');
    }
}
