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
        // Validate the incoming request
        $request->validate([
            'property_id' => 'required|max:255|integer',
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ensure it's an image file
            'caption' => 'nullable|string|max:255',
        ]);

        // Handle file upload
        if ($request->hasFile('path')) {
            // Store the image in the 'public/images/' directory
            // The 'public' disk is linked to 'storage/app/public'
            $imagePath = $request->file('path')->store('images', 'public');
        }

        // Store the image data in the database
        PropertyImage::create([
            'property_id' => $request->property_id,
            'path' => $imagePath,  // Store the file path in the database
            'caption' => $request->caption,
        ]);

        // Redirect or return response
        return redirect()->route('property_images.show',[$request->property_id])->with('success', 'Property image added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($property_id)
{
    // Fetch property images using the property_id
    $propertyImages = PropertyImage::where('property_id', $property_id)->get();
   
    // Check if the property images exist
    if ($propertyImages->isEmpty()) {
        abort(404, 'Property images not found.');
    }
    
    // Return the view with the property images and property_id
    return view('property_images.show', compact('propertyImages', 'property_id'));
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
    public function destroy($image_id)
    {
        // Find the image by ID
        $propertyImage = PropertyImage::findOrFail($image_id);

        // Delete the image file from storage (if exists)
        if ($propertyImage->path && file_exists(storage_path('app/public/' . $propertyImage->path))) {
            unlink(storage_path('app/public/' . $propertyImage->path));  // Delete the image file
        }

        // Delete the property image from the database
        $propertyImage->delete();

        // Redirect with a success message
        return redirect()->route('property_images.show',[$propertyImage->property_id])->with('success', 'Property image deleted successfully.');
    }
}
