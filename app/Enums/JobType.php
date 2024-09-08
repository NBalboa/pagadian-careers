<?php

namespace App\Enums;

enum JobType: int
{
    case PERMANENT = 0;
    case PART_TIME = 1;
    case FULL_TIME = 2;
    case CONTRACTUAL = 3;
}
