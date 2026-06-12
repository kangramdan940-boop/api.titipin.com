<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'slug', 'location', 'start_date', 'end_date', 'status', 'max_discount', 'emoji'];

    protected $casts = ['start_date' => 'date', 'end_date' => 'date'];

    public function products() { return $this->hasMany(Product::class); }
}
