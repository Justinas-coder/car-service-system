<?php

namespace App\Enums;

enum OrderStatus: string
{
    use EnumTrait;
    case COMPLETED = 'completed';
    case IN_PROGRESS = 'in progress';

    public function title(): string
    {
        return match ($this) {
            self::COMPLETED => 'completed',
            self::IN_PROGRESS => 'in progress',
        };
    }
}
