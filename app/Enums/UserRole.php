<?php

namespace App\Enums;

enum UserRole: int
{
    case ADMIN = 0;
    case APPLICANTS = 1;
    case HIRING_MANAGER = 2;
}
