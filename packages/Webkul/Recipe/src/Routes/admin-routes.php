<?php

use Illuminate\Support\Facades\Route;
use Webkul\Recipe\Http\Controllers\Admin\RecipeController;

Route::group([
    'middleware' => ['web', 'admin'],
    'prefix'     => config('app.admin_url') . '/recipes',
], function () {
    Route::get('/', [RecipeController::class, 'index'])->defaults('_config', [
        'view' => 'recipe::admin.index',
    ])->name('admin.recipes.index');

    Route::get('/create', [RecipeController::class, 'create'])->defaults('_config', [
        'view' => 'recipe::admin.create',
    ])->name('admin.recipes.create');

    Route::post('/create', [RecipeController::class, 'store'])->defaults('_config', [
        'redirect' => 'admin.recipes.index',
    ])->name('admin.recipes.store');

    Route::get('/edit/{id}', [RecipeController::class, 'edit'])->defaults('_config', [
        'view' => 'recipe::admin.edit',
    ])->name('admin.recipes.edit');

    Route::put('/edit/{id}', [RecipeController::class, 'update'])->defaults('_config', [
        'redirect' => 'admin.recipes.index',
    ])->name('admin.recipes.update');

    Route::delete('/{id}', [RecipeController::class, 'destroy'])->name('admin.recipes.destroy');
});
