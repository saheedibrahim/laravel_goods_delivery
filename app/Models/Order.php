<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'orderID',
        'destination',
        'lga',
        'address',
        'weight',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderDispatchers() : HasMany
    {
        return $this->hasMany(OrderDispatcher::class);
    }

    public function message(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
