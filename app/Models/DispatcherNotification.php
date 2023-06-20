<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DispatcherNotification extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'user_id',
        'dispatcher_id',
        'carry_status',
        'delivery_status',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
