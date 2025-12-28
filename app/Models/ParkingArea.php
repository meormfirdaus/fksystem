<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'category',
        'requires_booking',
        'status',
        'closed_reason',
    ];
    
    public function parkingSpaces()
    {
        return $this->hasMany(\App\Models\ParkingSpace::class);
    }
    public function spaces()
    {
        return $this->hasMany(ParkingSpace::class);
    }

}
