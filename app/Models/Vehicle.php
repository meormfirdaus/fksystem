<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plate_no',
        'type',
        'color',
        'status',
    ];

    public function user() { 
        return $this->belongsTo(\App\Models\User::class); 
    
    }
    public function approver() {
         return $this->belongsTo(\App\Models\User::class, 'approved_by'); 
        
    }





}
