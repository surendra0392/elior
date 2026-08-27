<?php

namespace Webkul\Recipe\Repositories;

use Webkul\Core\Eloquent\Repository;

class RecipeRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return 'Webkul\Recipe\Contracts\Recipe';
    }
}
