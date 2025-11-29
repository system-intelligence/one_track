<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $casts = [
        'last_maintenance' => 'date',
    ];
    protected $fillable = [
        'office',
        'user',
        'type',
        'os',
        'processor',
        'ram',
        'gpu',
        'ups',
        'avr',
        'condition',
        'last_maintenance',
    ];
}
