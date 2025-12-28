<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingSpace extends Model
{
    use HasFactory;

        protected $fillable = [
        'parking_area_id',
        'space_no',
        'qr_token',
        'status',
    ];
    public function parkingArea()
    {
        return $this->belongsTo(\App\Models\ParkingArea::class);
    }
}
