<?php

namespace App\Enum;

enum PermissionEnum: string
{
//    use EnumToArray;
    case PERMISSION_MANAGE_Admin = 'admin';
    case PERMISSION_MANAGE_CATEGORIES = 'manage categories';
    case PERMISSION_MANAGE_USERS = 'manage users';
    case PERMISSION_MANAGE_PRODUCTS = 'manage products';
    case PERMISSION_MANAGE_ROLE_PERMISSIONS = 'manage role_permissions';
    case PERMISSION_MANAGE_PAYMENTS = 'manage payments';
    case PERMISSION_MANAGE_BLOGS = "manage blogs";
    case PERMISSION_MANAGE_COMMENTS = "manage comments";
    case PERMISSION_MANAGE_BRAND = "manage brand";
}
