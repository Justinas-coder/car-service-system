<?php
namespace App\Models;

use App\Casts\Price;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Order extends Model
{
    use HasFactory;
    protected $casts = [
        'status' => OrderStatus::class,
        'total_price' => Price::class
    ];
    protected $fillable = [
        'user_id',
        'vehicle_make_id',
        'vehicle_model_id',
        'year',
        'service_id',
        'status',
        'total_price'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function vehicleMake(): BelongsTo
    {
        return $this->belongsTo(VehicleMake::class);
    }
    public function vehicleModel(): BelongsTo
    {
        return $this->belongsTo(VehicleModel::class);
    }
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
