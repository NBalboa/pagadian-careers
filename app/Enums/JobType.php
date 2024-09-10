<?php

namespace App\Enums;

enum JobType: int
{
    case PERMANENT = 0;
    case PART_TIME = 1;
    case FULL_TIME = 2;
    case CONTRACTUAL = 3;

    public static function fromValue(int $value): self
    {
        return match ($value) {
            0 => self::PERMANENT,
            1 => self::PART_TIME,
            2 => self::FULL_TIME,
            3 => self::CONTRACTUAL
        };
    }


    public function stringValue(): string
    {
        return match ($this) {
            self::PERMANENT => 'Permanent',
            self::PART_TIME => 'Part-Time',
            self::FULL_TIME => 'Full-Time',
            self::CONTRACTUAL => 'Contractual'
        };
    }
}
