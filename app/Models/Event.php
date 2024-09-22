<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'participants',
        'image'
    ];

    protected $casts = [
        'participants' => 'array'
    ];
    
    use HasFactory;
}
