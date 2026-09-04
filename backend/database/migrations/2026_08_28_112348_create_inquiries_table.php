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
        Schema::create('inquiries', function (Blueprint $table) {

    $table->id();

    $table->foreignId('property_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->foreignId('client_id')
        ->constrained('users')
        ->cascadeOnDelete();

    $table->text('message');

    $table->string('status')->default('pending');
    $table->index('status');

    $table->timestamps();
    $table->index(['property_id', 'status']);
    $table->index(['client_id', 'status']);

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
