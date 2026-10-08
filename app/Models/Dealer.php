<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dealer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_name',
        'phone',
        'description',
        'address',
        'city',
        'state',
        'country',
        'logo',
        'verification_status',
        'rating',
    ];

    protected $casts = [
        'rating' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Vehicles
    |--------------------------------------------------------------------------
    */

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Conversations
    |--------------------------------------------------------------------------
    */

    public function buyerConversations(): HasMany
    {
        return $this->hasMany(
            Conversation::class,
            'buyer_id'
        );
    }

    public function dealerConversations(): HasMany
    {
        return $this->hasMany(
            Conversation::class,
            'dealer_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    */

    public function sentMessages(): HasMany
    {
        return $this->hasMany(
            Message::class,
            'sender_id'
        );
    }
}