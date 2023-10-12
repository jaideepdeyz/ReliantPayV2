<?php
namespace App\Enums;

enum StatusEnum: string
{
    case SUBMITTED = 'Submitted'; // submission for both Dealer and Booking
    case REJECTED = 'Rejected';
    case APPROVED = 'Approved';
    case AUTHORIZED = 'Authorized';


}
