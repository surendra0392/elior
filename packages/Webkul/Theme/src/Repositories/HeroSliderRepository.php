<?php

namespace Webkul\Theme\Repositories;

use Webkul\Core\Eloquent\Repository;

class HeroSliderRepository extends Repository
{
    public function model()
    {
        return 'Webkul\Theme\Contracts\HeroSlider';
    }
}
