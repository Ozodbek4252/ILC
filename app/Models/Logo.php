<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $main_logo
 * @property string $small_logo
 * @property string $created_at
 * @property string $updated_at
 */
class Logo extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_logo',
        'small_logo'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'id' => 'integer',
        'main_logo' => 'string',
        'small_logo' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
