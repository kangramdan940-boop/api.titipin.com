<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['name', 'phone', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    public function carts() { return $this->hasMany(Cart::class); }
    public function orders() { return $this->hasMany(Order::class); }
    public function addresses() { return $this->hasMany(Address::class); }
}
