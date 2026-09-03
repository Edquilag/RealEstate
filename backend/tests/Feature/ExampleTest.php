<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('has the expected inquiry controller actions', function () {
    expect(method_exists(\App\Http\Controllers\Broker\InquiryController::class, 'update'))
        ->toBeTrue()
        ->and(method_exists(\App\Http\Controllers\InquiryController::class, 'store'))
        ->toBeTrue();
});
