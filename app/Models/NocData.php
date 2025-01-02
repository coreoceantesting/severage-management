<?php


// app/Models/NocData.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NocData extends Model
{
    // Define the relationship between NocData and PropertyType
    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class, 'property_type');  // Assuming property_type is the foreign key
    }
}
