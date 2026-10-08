<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'dealer_id',
        'vin',
        'make',
        'model',
        'year',
        'trim',
        'body_type',
        'color',
        'engine',
        'transmission',
        'fuel_type',
        'drivetrain',
        'mileage',
        'price',
        'city',
        'state',
        'country',
        'status',
        'vin_status',
        'history_checked',
        'description',
    ];

    protected $casts = [
        'year' => 'integer',
        'mileage' => 'integer',
        'price' => 'decimal:2',
        'history_checked' => 'boolean',
    ];

    public function dealer(): BelongsTo
    {
        return $this->belongsTo(Dealer::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(VehicleMedia::class)
            ->orderBy('sort_order');
    }

    public function displayName(): string
    {
        $name = trim(collect([
            $this->year,
            $this->make,
            $this->model,
        ])->filter()->implode(' '));

        return $name !== '' ? $name : 'Vehicle';
    }
}