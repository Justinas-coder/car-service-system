<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Invoice extends Model
{
    use HasFactory;
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    public function service(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
