<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 *
 * @property int id
 * @property string keywords
 * @property string description
 * @property string created_at
 * @property string updated_at
 */
class Seo extends Model
{
    use HasFactory;

    protected $fillable = ['keywords', 'description'];

    public static function getKeywords(): string
    {
        return Seo::first()->keywords;
    }

    public static function getDescription(): string
    {
        return Seo::first()->description;
    }
}
