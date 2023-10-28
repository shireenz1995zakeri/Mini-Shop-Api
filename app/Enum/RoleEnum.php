<?php

namespace App\Enum;

enum RoleEnum : string
{

    case ROLE_SUPER_ADMIN = 'admin';
    case ROLE_AUTHOR = 'author';
    case ROLE_USER = 'user';
}
