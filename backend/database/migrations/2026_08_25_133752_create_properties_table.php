<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('properties', function (Blueprint $table) {
    $table->id();

    $table->foreignId('broker_id')
          ->constrained('users')
          ->cascadeOnDelete();

    $table->string('title');
    $table->text('description');

    $table->string('property_type');
    $table->string('listing_type');

    $table->string('location');

    $table->decimal('price', 12, 2);

    $table->decimal('floor_area', 10, 2);

    $table->string('status')
          ->default('available');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
