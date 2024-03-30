<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $message
 * @property string $created_at
 * @property string $updated_at
 */
class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'message'
    ];

    public function getCreatedAtAttribute($value)
    {
        return date('Y.m.d H:i', strtotime($value));
    }
}
