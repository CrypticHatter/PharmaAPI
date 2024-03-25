<?php

namespace App\Enums;

enum Roles: string
{
    case OWNER = 'owner';
    case MANAGER = 'manager';
    case CASHIER = 'cashier';
}
