<?php

namespace App\Enums;

enum OrderStatus: string
{
    use EnumTrait;
    case COMPLETED = 'completed';
    case IN_PROGRESS = 'in_progress';
    case NOT_PAID = 'not_paid';

    public function title(): string
    {
        return match ($this) {
            self::COMPLETED => __('completed'),
            self::IN_PROGRESS => __('in_progress'),
            self::NOT_PAID => __('not_paid'),
        };
    }
}
