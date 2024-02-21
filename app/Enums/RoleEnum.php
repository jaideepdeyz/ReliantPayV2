<?php 
namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'Admin';
    case DEALER = 'Dealer';
    case AGENT = 'Agent';
    case AFFILIATE = 'Affilate';
    case TICKETER = 'Ticketer';
    case FINANCE = 'Finance';
}