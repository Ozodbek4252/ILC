<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property int $icon_id
 * @property string $icon_path
 * @property string $link
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Icon $icon
 */
class Social extends Model
{
    use HasFactory;

    protected $table = 'socials';

    protected $fillable = [
        'name',
        'icon_id',
        'link',
    ];

    public function icon()
    {
        return $this->belongsTo(Icon::class);
    }

    public function getIconPathAttribute()
    {
        return $this->icon->icon;
    }
}
