<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $icon
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class Icon extends Model
{
    use HasFactory;

    protected $fillable = ['icon', 'name'];

    protected $table = 'icons';

    public function getIconAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
