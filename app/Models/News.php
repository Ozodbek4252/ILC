<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $image
 * @property string $seo_keywords
 * @property string $seo_description
 * @property bool $is_published
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Translation[]|Collection $translations

 */
class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'image',
        'is_published',
        'seo_keywords',
        'seo_description',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }

    public function getimageAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
