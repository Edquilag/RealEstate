<?php

test('public property and inquiry routes exist', function () {
    expect(route('properties.index', absolute: false))->toBe('/properties')
        ->and(route('properties.show', ['id' => 1], false))->toBe('/properties/1')
        ->and(route('inquiries.create', ['property' => 1], false))->toBe('/properties/1/inquiries/create')
        ->and(route('inquiries.store', ['property' => 1], false))->toBe('/properties/1/inquiries');
});

test('broker dashboard routes exist for the role flow', function () {
    expect(route('broker.dashboard', absolute: false))->toBe('/broker/dashboard')
        ->and(route('broker.properties.index', absolute: false))->toBe('/broker/properties')
        ->and(route('broker.inquiries.index', absolute: false))->toBe('/broker/inquiries');
});
