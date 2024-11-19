<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyUnit extends Model
{
    use HasFactory;

    // Define the table name (optional if it matches the model name in snake_case)
    protected $table = 'property_unit';

    // Define the primary key (optional if it's `id`)
    protected $primaryKey = 'unit_id';

    // Define fillable fields for mass assignment
    protected $fillable = [
        'property_id',
        'unit_category',
        'unit_no',
        'unit_name',
        'unit_type',
        'person_allowed',
        'additionalbed',
        'mainimg',
        'isactive',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'property_id');
    }
}
