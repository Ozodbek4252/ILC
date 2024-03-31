<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $phone
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 */
class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'email',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }
}
