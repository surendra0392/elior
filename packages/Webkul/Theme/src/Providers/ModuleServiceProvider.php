<?php

namespace Webkul\Theme\Providers;

use Webkul\Core\Providers\CoreModuleServiceProvider;
use Webkul\Theme\Models\ThemeCustomization;
use Webkul\Theme\Models\ThemeCustomizationTranslation;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    /**
     * Define the models
     *
     * @var array
     */
    protected $models = [
        ThemeCustomization::class,
        ThemeCustomizationTranslation::class,
        \Webkul\Theme\Models\HeroSlider::class,
        \Webkul\Theme\Models\HeroSlide::class,
        \Webkul\Theme\Models\HeroLayer::class,
    ];
}
