<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @package App\Models
 *
 * @property int $id
 * @property int $lang_id
 * @property string $translationable_id
 * @property string $translationable_type
 * @property string $content
 * @property string $column_name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Lang $lang
 */
class Translation extends Model
{
    use HasFactory;

    protected $fillable = [
        'lang_id',
        'translationable_id',
        'translationable_type',
        'content',
        'column_name'
    ];

    public function lang(): BelongsTo
    {
        return $this->belongsTo(Lang::class);
    }
}
