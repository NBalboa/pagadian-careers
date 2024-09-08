<?php

namespace App\Enums;

enum UserRole: int
{
        //0 = admin, 1 = applicants,  2 = hiring manager 
    case ADMIN = 0;
    case APPLICANTS = 1;
    case HIRING_MANAGER = 2;
}
