<?php

namespace App\Enums;

enum JobSetup: int
{
    case ON_SITE = 0;
    case REMOTE = 1;
    case HYBRID = 2;
}
