<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'property';
    
    protected $primaryKey = 'destination_id'; // Set the primary key

    public $incrementing = true; // Disable auto-increment if necessary

    protected $keyType = 'int'; // Set key type, e.g., 'string' for UUIDs or 'int' for integers

    protected $fillable = [
        'category_id',
        'destination_id',
        'property_name',
        'description',
        'district-city',
        'address',
        'lat-long',
        'main_img',
        'isactive',
    ];
}
