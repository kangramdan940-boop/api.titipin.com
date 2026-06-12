<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        return response()->json(Event::withCount('products')->orderByRaw("FIELD(status, 'active', 'upcoming', 'ended')")->get());
    }

    public function show(string $id)
    {
        return response()->json(Event::with('products')->where('slug', $id)->orWhere('id', $id)->firstOrFail());
    }
}
