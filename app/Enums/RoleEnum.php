<?php
namespace App\Enums;
enum RoleEnum: string
{
    case PRODUCER = 'producer';
    case AFFILIATE = 'affiliate';
    case ADMIN = 'admin';
}
