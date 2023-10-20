<?php
namespace App\Enums;

enum StatusEnum: string
{
    case SUBMITTED = 'Submitted'; // submission for both Dealer and Booking
    case REJECTED = 'Rejected';
    case APPROVED = 'Approved';
    case INACTIVE = 'Deactivated'; // user login deactivated
    case ACTIVE = 'Activated'; // user login activated
    case DRAFT = 'Draft'; // new sale booking initiated
    case PENDING = 'Pending'; // sale authorization pending
    case AUTHORIZED = 'Authorized'; // sales authorized
    case FAILED = 'Failed'; // Sales Failed after a certain period of time
    case CHARGEBACK = 'Chargeback'; // Sales Cahrgedback by customer


}
