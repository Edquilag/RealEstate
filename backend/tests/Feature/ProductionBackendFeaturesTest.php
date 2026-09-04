<?php

use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns filtered property listings for production search queries', function () {
    $broker = User::factory()->create(['role' => 'broker', 'status' => 'approved']);

    Property::factory()->create([
        'broker_id' => $broker->id,
        'title' => 'Skyline Tower Office',
        'property_type' => 'Office',
        'listing_type' => 'sale',
        'location' => 'Makati City',
        'price' => 20000000,
        'status' => 'available',
    ]);

    Property::factory()->create([
        'broker_id' => $broker->id,
        'title' => 'Harbor Warehouse',
        'property_type' => 'Warehouse',
        'listing_type' => 'lease',
        'location' => 'Cebu City',
        'price' => 9000000,
        'status' => 'available',
    ]);

    $response = $this->getJson('/api/v1/properties?keyword=Skyline&property_type=Office&location=Makati&price_min=15000000&price_max=30000000');

    $response->assertOk()
        ->assertJsonPath('meta.total', 1)
        ->assertJsonPath('data.0.title', 'Skyline Tower Office');
});

it('supports inquiry status lifecycle updates for broker workflows', function () {
    $broker = User::factory()->create(['role' => 'broker', 'status' => 'approved']);
    $client = User::factory()->create(['role' => 'client', 'status' => 'approved']);
    $property = Property::factory()->create(['broker_id' => $broker->id, 'status' => 'available']);

    $inquiry = $this->actingAs($client)->postJson('/api/v1/properties/'.$property->id.'/inquiries', [
        'message' => 'I would like to schedule a viewing for this property.',
    ]);

    $inquiry->assertCreated();

    $id = $inquiry->json('data.id');

    $this->actingAs($broker)
        ->patchJson('/api/v1/broker/inquiries/'.$id, ['status' => 'contacted'])
        ->assertOk()
        ->assertJsonPath('data.status', 'contacted');
});

it('applies rate limiting and returns structured validation errors', function () {
    $broker = User::factory()->create(['role' => 'broker', 'status' => 'approved']);
    $client = User::factory()->create(['role' => 'client', 'status' => 'approved']);
    $property = Property::factory()->create(['broker_id' => $broker->id, 'status' => 'available']);

    $invalid = $this->actingAs($client)->postJson('/api/v1/properties/'.$property->id.'/inquiries', [
        'message' => 'short',
    ]);

    $invalid->assertStatus(422)
        ->assertJsonPath('errors.message.0', __('validation.min.string', ['attribute' => 'message', 'min' => 10]));
});
