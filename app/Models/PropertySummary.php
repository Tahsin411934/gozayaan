<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertySummary extends Model
{
    use HasFactory;
    protected $table = 'property_summary';
    protected $fillable = ['property_id', 'value', 'image', 'display'];

    // Define the relationship to the Property model (if exists)
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}

