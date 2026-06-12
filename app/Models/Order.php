<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_number', 'user_id', 'address_id', 'subtotal', 'fee', 'ongkir', 'total', 'status', 'resi', 'ekspedisi', 'notes'];

    public function user() { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(OrderItem::class); }
    public function address() { return $this->belongsTo(Address::class); }
}
