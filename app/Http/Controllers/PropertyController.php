<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    // Display a listing of the properties
    public function index()
    {
        $properties = Property::all();
        return view('properties.index', compact('properties'));
    }

    // Show the form for creating a new property
    public function create()
    {
        return view('properties.create');
    }

    // Store a newly created property in storage
    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'category_id' => 'required|integer',
            'destination_id' => 'required|integer',
            'property_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'district-city' => 'required|string|max:255',  // Use 'district-city' as in the form
            'address' => 'required|string|max:255',
            'lat-long' => 'nullable|string',
            'main_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'isactive' => 'boolean',
        ]);

        // Handle file upload if it exists
        if ($request->hasFile('main_img')) {
            $imageName = time() . '.' . $request->main_img->extension();
            $request->main_img->move(public_path('images'), $imageName);
            $validatedData['main_img'] = $imageName;
        }

        // Create a new property record in the database
        Property::create($validatedData);

        return redirect()->route('properties.index')->with('success', 'Property added successfully!');
    }

    // Display the specified property
    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }

    // Show the form for editing the specified property
    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
    }

    // Update the specified property in storage
    public function update(Request $request, Property $property)
    {
        // Validate form data for updating
        $validatedData = $request->validate([
            'category_id' => 'required|integer',
            'destination_id' => 'required|integer',
            'property_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'district-city' => 'required|string|max:255', // Use 'district-city' as in the form
            'address' => 'required|string|max:255',
            'lat_long' => 'nullable|string',
            'main_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'isactive' => 'boolean',
        ]);

        // Handle file upload if it exists
        if ($request->hasFile('main_img')) {
            $imageName = time() . '.' . $request->main_img->extension();
            $request->main_img->move(public_path('images'), $imageName);
            $validatedData['main_img'] = $imageName;
        }

        // Update the existing property record
        $property->update($validatedData);

        return redirect()->route('properties.index')->with('success', 'Property updated successfully!');
    }

    // Remove the specified property from storage
    public function destroy(Property $property)
    {
        // Delete the property record
        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Property deleted successfully!');
    }
}
