<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'dealer_id',
        'vehicle_id',
        'pair_key',
    ];

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(Dealer::class, 'buyer_id');
    }

    public function dealer(): BelongsTo
    {
        return $this->belongsTo(Dealer::class, 'dealer_id');
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function latestMessage(): HasOne
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }

    public function mentionedVehicles(): BelongsToMany
    {
        return $this->belongsToMany(
            Vehicle::class,
            'messages',
            'conversation_id',
            'vehicle_id'
        )->distinct();
    }

    public function scopeForDealer($query, int $dealerId)
    {
        return $query->where(function ($query) use ($dealerId) {
            $query
                ->where('buyer_id', $dealerId)
                ->orWhere('dealer_id', $dealerId);
        });
    }

    public function otherDealer(Dealer $currentDealer): ?Dealer
    {
        if ((int) $this->buyer_id === (int) $currentDealer->id) {
            return $this->dealer;
        }

        return $this->buyer;
    }

    public function involvesDealer(int $dealerId): bool
    {
        return (int) $this->buyer_id === $dealerId
            || (int) $this->dealer_id === $dealerId;
    }

    public static function pairKey(int $dealerA, int $dealerB): string
    {
        $ids = [$dealerA, $dealerB];
        sort($ids);

        return $ids[0].':'.$ids[1];
    }

    /**
     * One unordered dealer pair = one conversation.
     */
    public static function findOrCreateBetween(int $dealerA, int $dealerB): self
    {
        abort_if($dealerA === $dealerB, 403);

        $pairKey = static::pairKey($dealerA, $dealerB);

        return DB::transaction(function () use ($dealerA, $dealerB, $pairKey) {
            $existing = static::query()
                ->where('pair_key', $pairKey)
                ->lockForUpdate()
                ->first();

            if ($existing) {
                return $existing;
            }

            $existing = static::query()
                ->where(function ($query) use ($dealerA, $dealerB) {
                    $query->where(function ($query) use ($dealerA, $dealerB) {
                        $query
                            ->where('buyer_id', $dealerA)
                            ->where('dealer_id', $dealerB);
                    })->orWhere(function ($query) use ($dealerA, $dealerB) {
                        $query
                            ->where('buyer_id', $dealerB)
                            ->where('dealer_id', $dealerA);
                    });
                })
                ->lockForUpdate()
                ->orderBy('id')
                ->first();

            if ($existing) {
                if ($existing->pair_key !== $pairKey || $existing->vehicle_id) {
                    $existing->update([
                        'pair_key' => $pairKey,
                        'vehicle_id' => null,
                    ]);
                }

                return $existing;
            }

            return static::create([
                'buyer_id' => $dealerA,
                'dealer_id' => $dealerB,
                'vehicle_id' => null,
                'pair_key' => $pairKey,
            ]);
        });
    }
};
