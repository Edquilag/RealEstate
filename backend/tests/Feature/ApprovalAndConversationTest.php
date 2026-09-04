<?php

use App\Models\Property;
use App\Models\User;

it('creates a pending broker registration with compliance details', function () {
    $response = $this->post('/register', [
        'name' => 'Broker Test',
        'email' => 'broker.test@example.com',
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
        'role' => 'broker',
        'company_name' => 'Test Realty Co.',
        'office_address' => '123 Main Street, Makati',
        'prc_license_number' => 'PRC-123456',
        'prc_license_expiry' => '2035-12-31',
        'tin' => '123-456-789-000',
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertDatabaseHas('users', [
        'email' => 'broker.test@example.com',
        'role' => 'broker',
        'status' => 'pending',
        'company_name' => 'Test Realty Co.',
    ]);
    $this->assertDatabaseHas('broker_profiles', [
        'company_name' => 'Test Realty Co.',
        'prc_license_number' => 'PRC-123456',
        'status' => 'pending',
    ]);
});

it('shows pending approvals to the admin and allows approval', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => 'approved']);
    $broker = User::factory()->create(['role' => 'broker', 'status' => 'pending']);

    $this
        ->actingAs($admin)
        ->get('/admin/approvals')
        ->assertOk();

    $this
        ->actingAs($admin)
        ->post('/admin/approvals/'.$broker->id.'/approve')
        ->assertRedirect('/admin/approvals');

    $this->assertDatabaseHas('users', [
        'id' => $broker->id,
        'status' => 'approved',
    ]);
});

it('creates a conversation when a client sends an inquiry', function () {
    $broker = User::factory()->create(['role' => 'broker', 'status' => 'approved']);
    $client = User::factory()->create(['role' => 'client', 'status' => 'approved']);
    $property = Property::factory()->create(['broker_id' => $broker->id, 'status' => 'available']);

    $response = $this
        ->actingAs($client)
        ->post('/properties/'.$property->id.'/inquiries', [
            'message' => 'I want to schedule a visit.',
        ]);

    $response->assertRedirect('/properties/'.$property->id);

    $this->assertDatabaseHas('inquiries', [
        'property_id' => $property->id,
        'client_id' => $client->id,
        'broker_id' => $broker->id,
    ]);

    $this->assertDatabaseHas('conversations', [
        'property_id' => $property->id,
        'client_id' => $client->id,
        'broker_id' => $broker->id,
    ]);
});
