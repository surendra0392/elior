<?php

namespace Webkul\Recipe\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Recipe\Contracts\RecipeTranslation as RecipeTranslationContract;

class RecipeTranslation extends Model implements RecipeTranslationContract
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'url_key',
        'description',
        'ingredients',
        'instructions',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'ingredients'  => 'array',
        'instructions' => 'array',
    ];
}
