<?php

use Illuminate\Support\Facades\Hash;
use Webkul\Faker\Helpers\Customer as CustomerFaker;

use function Pest\Laravel\postJson;

it('should fail validation when email and password are not provided to login API', function () {
    postJson(route('shop.api.customers.session.create'))
        ->assertJsonValidationErrorFor('email')
        ->assertJsonValidationErrorFor('password')
        ->assertUnprocessable();
});

it('should fail when wrong credentials are provided to login API', function () {
    $customer = (new CustomerFaker)->factory()->create([
        'password' => Hash::make('password123'),
        'status' => 1,
        'is_verified' => 1,
    ]);

    postJson(route('shop.api.customers.session.create'), [
        'email' => $customer->email,
        'password' => 'wrongpassword',
    ])
        ->assertForbidden();
});

it('should successfully log in customer via login API', function () {
    $customer = (new CustomerFaker)->factory()->create([
        'password' => Hash::make($password = 'password123'),
        'status' => 1,
        'is_verified' => 1,
    ]);

    postJson(route('shop.api.customers.session.create'), [
        'email' => $customer->email,
        'password' => $password,
    ])
        ->assertOk();

    expect(auth()->guard('customer')->check())->toBeTrue();
    expect(auth()->guard('customer')->user()->id)->toBe($customer->id);
});
