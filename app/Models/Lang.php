<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $icon
 * @property bool $is_published
 * @property string $created_at
 * @property string $updated_at
 */
class Lang extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'icon',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
