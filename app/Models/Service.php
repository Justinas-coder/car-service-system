<?php
namespace App\Models;
use App\Casts\Price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Service extends Model
{
    use HasFactory;
    protected $casts = [
        'price' => Price::class
    ];
    protected $fillable = [
        'name',
        'description',
        'price'
    ];
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}
