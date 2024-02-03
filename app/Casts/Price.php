<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Price implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): ?string
    {
        return $value === null ? null : number_format($value / 10000, 2, '.', '');
    }

    public function set($model, string $key, $value, array $attributes): ?int
    {
        return $value === null ? null : (int) round($value * 10000); //round is a MUST to prevent issues with rounding floating numbers
    }
}
