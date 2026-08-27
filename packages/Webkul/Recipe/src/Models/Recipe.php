<?php

namespace Webkul\Recipe\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Webkul\Recipe\Contracts\Recipe as RecipeContract;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Webkul\Product\Models\ProductProxy;

class Recipe extends Model implements RecipeContract, TranslatableContract
{
    use Translatable;

    protected $fillable = [
        'status',
        'featured_image',
        'prep_time',
        'cook_time',
        'difficulty',
        'servings',
    ];

    public $translatedAttributes = [
        'name',
        'url_key',
        'description',
        'ingredients',
        'instructions',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    /**
     * Get the products associated with the recipe.
     */
    public function products()
    {
        return $this->belongsToMany(ProductProxy::modelClass(), 'recipe_products');
    }
}
