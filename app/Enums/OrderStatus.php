<?php

namespace App\Enums;

//enum CountryCodeFormatType: string
//{
//    use EnumTrait;
//
//    case DIGITAL_CODE = 'digital_code';
//    case ISO_CODE = 'iso_code';
//
//    public function title(): string
//    {
//        return match ($this) {
//            self::DIGITAL_CODE => 'ISO-3166 Alpha-3 (3 Letters)',
//            self::ISO_CODE => 'ISO-3166 Alpha-2 (2 Letters)',
//        };
//    }
//}

enum OrderStatus: string
{
    use EnumTrait;
    case COMPLETED = 'completed';
    case IN_PROGRESS = 'in_progress';

    public function title(): string
    {
        return match ($this) {
            self::COMPLETED => 'completed',
            self::IN_PROGRESS => 'in_progress',
        };
    }
}
