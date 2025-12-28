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
        'brand',
        'model',
        'grant_path',
        'approval_status',
        'approved_by',
        'approved_at',
        'approval_note',
    ];

    public function user() { 
        return $this->belongsTo(\App\Models\User::class); 
    
    }
    public function approver() {
         return $this->belongsTo(\App\Models\User::class, 'approved_by'); 
        
    }





}
