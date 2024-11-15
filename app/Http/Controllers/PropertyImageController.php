<?php

namespace App\Http\Controllers;

use App\Models\PropertyImage;
use Illuminate\Http\Request;

class PropertyImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = PropertyImage::all();
        return view('property_images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('property_images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:property,property_id',
            'path' => 'required|string|max:255',
            'caption' => 'nullable|string|max:255',
        ]);

        PropertyImage::create($validated);

        return redirect()->route('property_images.index')->with('success', 'Property Image added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyImage $propertyImage)
    {
        return view('property_images.show', compact('propertyImage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyImage $propertyImage)
    {
        return view('property_images.edit', compact('propertyImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PropertyImage $propertyImage)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:property,property_id',
            'path' => 'required|string|max:255',
            'caption' => 'nullable|string|max:255',
        ]);

        $propertyImage->update($validated);

        return redirect()->route('property_images.index')->with('success', 'Property Image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyImage $propertyImage)
    {
        $propertyImage->delete();

        return redirect()->route('property_images.index')->with('success', 'Property Image deleted successfully.');
    }
}
