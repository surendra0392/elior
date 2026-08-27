<?php

use Webkul\Customer\Models\Customer;

it('renders customer reviews page without errors', function () {
    $customer = Customer::first();
    $this->actingAs($customer, 'customer');

    $response = $this->get(route('shop.customers.account.reviews.index'));

    $response->assertOk();
    $response->assertSee('Reviews');
});
