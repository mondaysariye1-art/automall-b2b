<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vehicle_requests', function (Blueprint $table) {
            $table->enum('usage_type', [
                'nigerian_used',
                'foreign_used',
                'brand_new',
            ])->default('nigerian_used')->after('body_type');

            $table->enum('location_scope', [
                'state',
                'nationwide',
            ])->default('state')->after('country');

            $table->dropColumn('country');
        });
    }

    public function down(): void
    {
        Schema::table('vehicle_requests', function (Blueprint $table) {
            $table->string('country', 100)
                ->default('Nigeria')
                ->after('state');

            $table->dropColumn([
                'usage_type',
                'location_scope',
            ]);
        });
    }
};
