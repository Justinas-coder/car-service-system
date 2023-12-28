<?php

namespace App\Enums;

trait EnumTrait
{
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($enum) => [
                $enum->value => $enum->title(),
            ])
            ->all();
    }

    public static function randomEnum(): self
    {
        $statuses = self::cases();

        return $statuses[array_rand($statuses)];
    }
}
