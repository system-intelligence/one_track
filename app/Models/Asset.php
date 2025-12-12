<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $casts = [
        'peripherals' => 'array',
    ];
    protected $fillable = [
        'office',
        'user',
        'type',
        'os',
        'processor',
        'ram',
        'gpu',
        'peripherals',
        'surge_protector',
        'condition',
    ];

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
}
