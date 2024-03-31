<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $background_image
 * @property string $sec1_image
 * @property string $sec2_image
 * @property string $background_image_url
 * @property string $sec1_image_url
 * @property string $sec2_image_url
 *
 * @property string $translations->title
 * @property string $translations->sub_title
 * @property string $translations->sec1_description
 * @property string $translations->sec2_description
 *
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Translation[]|Collection $translations
 */
class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'background_image',
        'sec1_image',
        'sec2_image',
    ];

    public function getBackgroundImageUrlAttribute()
    {
        return asset('storage/' . $this->background_image);
    }

    public function getSec1ImageUrlAttribute()
    {
        return asset('storage/' . $this->sec1_image);
    }

    public function getSec2ImageUrlAttribute()
    {
        return asset('storage/' . $this->sec2_image);
    }

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }
}
