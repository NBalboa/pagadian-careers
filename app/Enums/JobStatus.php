<?php

namespace App\Enums;

enum JobStatus: int
{
        //0 = PENDING, 1 = INTERVIEW, 2 = HIRED
    case PENDING = 0;
    case INTERVIEW = 1;
    case HIRED = 2;

    public static function fromValue(int $value): self
    {
        return match ($value) {
            0 => self::PENDING,
            1 => self::INTERVIEW,
            2 => self::HIRED
        };
    }


    public function stringValue(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::INTERVIEW => 'Interview',
            self::HIRED => 'Hired',
        };
    }
}
