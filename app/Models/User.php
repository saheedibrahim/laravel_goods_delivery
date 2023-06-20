<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// use App\Http\Controllers\OrderDispatcher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'location',
        'lga',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function orderOrderDispatcher(): HasOneThrough
    {
        return $this->hasOneThrough(OrderDispatcher::class, Order::class)->withDefault();
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    
    public function orderDispatchers() : HasMany
    {
        return $this->hasMany(OrderDispatcher::class);
    }
    
    public function dispatcherNotification() : HasMany
    {
        return $this->hasMany(DispatcherNotification::class);
    }
    
    public function declinedGoods() : HasMany
    {
        return $this->hasMany(DeclinedGoods::class);
    } 
}
