<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDispatcher extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'user_id',
        'dispatcher_id',
    ];

    public function dispatcher(): BelongsTo
    {
        return $this->belongsTo(Dispatcher::class);
    }
    
    public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function dispatchers(): BelongsTo
    {
        return $this->belongsTo(Dispatcher::class, 'dispatcher_id');
    }
}
