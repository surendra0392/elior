<?php

use Webkul\Faker\Helpers\Product as ProductFaker;

use function Pest\Laravel\get;
use function Pest\Laravel\postJson;

it('loads checkout onepage without any server errors', function () {
    $product = (new ProductFaker)->getSimpleProductFactory()->create();

    postJson(route('shop.api.checkout.cart.store'), [
        'product_id' => $product->id,
        'quantity'   => 1,
    ])->assertOk();

    get(route('shop.checkout.onepage.index'))
        ->assertOk();
});
