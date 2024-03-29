<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $file
 * @property string $type
 * @property string $file_type
 * @property bool $is_published
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Translation[]|Collection $translations
 */
class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['file', 'type', 'file_type', 'is_published'];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function getFileAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }
}
