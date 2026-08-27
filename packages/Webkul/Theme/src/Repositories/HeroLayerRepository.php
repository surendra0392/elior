<?php

namespace Webkul\Theme\Repositories;

use Webkul\Core\Eloquent\Repository;

class HeroLayerRepository extends Repository
{
    public function model()
    {
        return 'Webkul\Theme\Contracts\HeroLayer';
    }
}
