<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('buyer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('dealer_id')
                ->constrained('dealers')
                ->cascadeOnDelete();

            $table->foreignId('vehicle_id')
                ->nullable()
                ->constrained('vehicles')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['buyer_id', 'dealer_id']);
            $table->index(['dealer_id', 'vehicle_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};