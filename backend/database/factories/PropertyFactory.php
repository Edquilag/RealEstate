<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition(): array
    {
        return [
            'broker_id' => User::factory()->create(['role' => 'broker', 'status' => 'approved'])->id,
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'property_type' => 'Office',
            'listing_type' => 'sale',
            'location' => 'Makati City',
            'price' => 25000000,
            'floor_area' => 120.5,
            'status' => 'available',
        ];
    }
}
