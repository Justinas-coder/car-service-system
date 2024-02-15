<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'vehicle_make_id'
    ];

    public function make(): BelongsTo
    {
        return $this->belongsTo(VehicleMake::class);
    }
}
