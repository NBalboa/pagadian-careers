<?php

namespace App\Enums;

enum JobSetup: int
{
    case ON_SITE = 0;
    case REMOTE = 1;
    case HYBRID = 2;

    public static function fromValue(int $value): self
    {
        return match ($value) {
            0 => self::ON_SITE,
            1 => self::REMOTE,
            2 => self::HYBRID
        };
    }


    public function stringValue(): string
    {
        return match ($this) {
            self::ON_SITE => 'On-Site',
            self::REMOTE => 'Remote',
            self::HYBRID => 'Hybrid',
        };
    }
}
