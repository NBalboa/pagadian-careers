<?php

namespace App\Enums;

enum EducationAttainment: int
{
    case ElementaryGraduate = 0;
    case HighSchoolGraduate = 1;
    case AssociateDegree = 2;
    case BachelorDegree = 3;
    case MasterDegree = 4;
    case DoctorateDegree = 5;

    public static function fromValue(int $value): self
    {
        return match ($value) {
            0 => self::ElementaryGraduate,
            1 => self::HighSchoolGraduate,
            2 => self::AssociateDegree,
            3 => self::BachelorDegree,
            4 => self::MasterDegree,
            5 => self::DoctorateDegree
        };
    }


    public function stringValue(): string
    {
        return match ($this) {
            self::ElementaryGraduate => 'Elementary Graduate',
            self::HighSchoolGraduate => 'High School Graduate',
            self::AssociateDegree => 'Associate Degree',
            self::BachelorDegree => "Bachelor's Degree",
            self::MasterDegree => "Master's Degree",
            self::DoctorateDegree => 'Doctorate Degree'
        };
    }
}
