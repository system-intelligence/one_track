<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $casts = [
        'date' => 'date',
    ];

    protected $fillable = [
        'asset_id',
        'date',
        'user_name',
        'description',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
