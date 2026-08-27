<?php

use Illuminate\Support\Facades\Route;
use Webkul\Recipe\Http\Controllers\Shop\RecipeController;

Route::group([
    'middleware' => ['web', 'locale', 'theme', 'currency'],
], function () {

    Route::get('/recipes', [RecipeController::class, 'index'])->defaults('_config', [
        'view' => 'recipe::shop.index',
    ])->name('shop.recipes.index');

    Route::get('/recipes/{url_key}', [RecipeController::class, 'view'])
        ->where('url_key', '.*')
        ->defaults('_config', [
            'view' => 'recipe::shop.view',
        ])->name('shop.recipes.view');

});
