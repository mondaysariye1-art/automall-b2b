<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'dealer_id',
        'make',
        'model',
        'year',
        'trim',
        'body_type',
        'usage_type',
        'min_budget',
        'max_budget',
        'location_scope',
        'city',
        'state',
        'description',
        'status',
    ];

    protected $casts = [
        'year' => 'integer',
        'min_budget' => 'integer',
        'max_budget' => 'integer',
    ];

    public function dealer(): BelongsTo
    {
        return $this->belongsTo(Dealer::class);
    }
}
