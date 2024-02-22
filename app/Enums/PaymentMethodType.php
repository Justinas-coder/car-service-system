<?php

namespace App\Enums;

enum PaymentMethodType: string
{
    use EnumTrait;

    case CREDIT_CARD = 'credit_card';
    case WIRE_TRANSFER = 'wire_transfer';

    public function title(): string
    {
        return match ($this) {
            self::CREDIT_CARD => __('Credit Card'),
            self::WIRE_TRANSFER => __('Invoice Payment'),
        };
    }
}
