<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $image
 * @property string $name
 * @property string $image_url
 * @property string $created_at
 * @property string $updated_at
 */
class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
    ];

    protected $casts = [
        'image' => 'string',
        'name' => 'string',
    ];

    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image);
    }
}
