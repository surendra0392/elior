<?php

namespace Webkul\Theme\Repositories;

use Webkul\Core\Eloquent\Repository;

class HeroSlideRepository extends Repository
{
    public function model()
    {
        return 'Webkul\Theme\Contracts\HeroSlide';
    }
}
