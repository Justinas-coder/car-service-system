<?php

namespace App\Enums;

enum OrderStatus: string
{
    use EnumTrait;
    case COMPLETED = 'completed';
    case IN_PROGRESS = 'in_progress';

    public function title(): string
    {
        return match ($this) {
            self::COMPLETED => 'Completed',
            self::IN_PROGRESS => 'In progress',
        };
    }
}
