@props([
    'name'  => '',
    'entity' => null,
])

<div class="site-container pt-4 pb-2 sm:pt-6 sm:pb-3">
    <div class="flex items-center">        
        {{ Breadcrumbs::view('shop::partials.breadcrumbs', $name, $entity) }}
    </div>
</div>

