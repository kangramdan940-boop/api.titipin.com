<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'category_id', 'event_id', 'price', 'original_price', 'description', 'emoji', 'gradient', 'image_url', 'video_url', 'wa_message', 'stock', 'is_active'];

    public function category() { return $this->belongsTo(Category::class); }
    public function event() { return $this->belongsTo(Event::class); }
}
