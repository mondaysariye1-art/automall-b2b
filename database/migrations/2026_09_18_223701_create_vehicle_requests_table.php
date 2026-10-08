<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('dealer_id')
                ->constrained('dealers')
                ->cascadeOnDelete();

            $table->string('make', 100);
            $table->string('model', 100);
            $table->unsignedSmallInteger('year')->nullable();
            $table->string('trim', 100)->nullable();
            $table->string('body_type', 100)->nullable();

            $table->unsignedInteger('min_budget')->nullable();
            $table->unsignedInteger('max_budget')->nullable();

            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('country', 100)->default('Nigeria');

            $table->text('description')->nullable();

            $table->enum('status', [
                'open',
                'fulfilled',
                'cancelled',
            ])->default('open');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_requests');
    }
};
