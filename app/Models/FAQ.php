<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 *
 * @property int $id
 * @property string $translations->question
 * @property string $translations->answer
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Translation[]|Collection $translations
 */
class FAQ extends Model
{
    use HasFactory;

    protected $table = 'faqs';

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }
}
