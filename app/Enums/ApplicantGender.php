<?php

namespace App\Enums;

enum ApplicantGender: int
{
    case MALE = 0;
    case FEMALE = 1;

    public static function fromValue(int $value): self
    {
        return match ($value) {
            0 => self::MALE,
            1 => self::FEMALE,
        };
    }


    public function stringValue(): string
    {
        return match ($this) {
            self::MALE => 'MALE',
            self::FEMALE => 'FEMALE',
        };
    }
}
