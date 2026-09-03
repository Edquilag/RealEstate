<?php

namespace App\Http\Controllers;

use App\Models\Property;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with('images')
            ->where('status', 'available')
            ->latest()
            ->get();

        return view('properties.index', compact('properties'));
    }


    public function show(string $id)
    {
        $property = Property::with(['images', 'broker'])
            ->findOrFail($id);

        return view('properties.show', compact('property'));
    }
}