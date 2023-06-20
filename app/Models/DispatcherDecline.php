<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DispatcherDecline extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'user_id',
        'dispatcher_id',
        'declined',
    ];

    public function dispatcher(): BelongsTo
    {
        return $this->belongsTo(Dispatcher::class, 'dispatcher_id');
    }
}
