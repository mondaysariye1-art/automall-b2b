<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            // Dealer who owns/listed the vehicle
            $table->foreignId('dealer_id')
                ->constrained('dealers')
                ->cascadeOnDelete();

            // VIN
            $table->string('vin', 17)->unique();

            // Basic vehicle information
            $table->string('make');
            $table->string('model');
            $table->unsignedSmallInteger('year');

            $table->string('trim')->nullable();
            $table->string('body_type')->nullable();
            $table->string('color')->nullable();

            // Mechanical information
            $table->string('engine')->nullable();
            $table->string('transmission')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('drivetrain')->nullable();

            // Mileage and pricing
            $table->unsignedInteger('mileage')->nullable();
            $table->decimal('price', 12, 2)->nullable();

            // Location
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->default('Nigeria');

            // Listing status
            $table->enum('status', [
                'draft',
                'active',
                'sold',
                'reserved',
                'archived'
            ])->default('draft');

            // VIN decoding / verification status
            $table->enum('vin_status', [
                'pending',
                'valid',
                'invalid'
            ])->default('pending');

            // Vehicle history is separate from VIN validity
            $table->boolean('history_checked')->default(false);

            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};