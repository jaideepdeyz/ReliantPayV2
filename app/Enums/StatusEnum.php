<?php
namespace App\Enums;

enum StatusEnum: string
{
    case SUBMITTED = 'Submitted'; // submission for both Dealer and Booking
    case REJECTED = 'Rejected';
    case APPROVED = 'Approved';
    case AUTHORIZED = 'Authorized';
    case INACTIVE = 'Deactivated'; // user login deactivated
    case ACTIVE = 'Activated'; // user login activated


}
