<?php

return [
    [
        'key'   => 'recipes',
        'name'  => 'recipe::app.admin.menu.recipes',
        'route' => 'admin.recipes.index',
        'sort'  => 5,
    ],
    [
        'key'   => 'recipes.create',
        'name'  => 'recipe::app.admin.acl.create',
        'route' => 'admin.recipes.store',
        'sort'  => 1,
    ],
    [
        'key'   => 'recipes.edit',
        'name'  => 'recipe::app.admin.acl.edit',
        'route' => 'admin.recipes.update',
        'sort'  => 2,
    ],
    [
        'key'   => 'recipes.delete',
        'name'  => 'recipe::app.admin.acl.delete',
        'route' => 'admin.recipes.destroy',
        'sort'  => 3,
    ],
];
