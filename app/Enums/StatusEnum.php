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
    case PENDING = 'Authorization Pending'; // sale authorization pending
    case SENT_FOR_AUTH='Sent for Authorization'; // sale sent for authorization
    case AUTHORIZED = 'Authorized'; // sales authorized
    case FAILED = 'Failed'; // Sales Failed after a certain period of time
    case CHARGEBACK = 'Chargeback'; // Sales Cahrgedback by customer
    case DELETED = 'Deleted'; // Sales Cahrgedback by customer
    case PAYMENT_DONE = 'Payment Done';
    case TICKET_ISSUED = 'Ticket Issued';
    case CANCELLATION_REQUESTED = 'Cancellation Requested'; // this is for internal customers only initiated by agent, need to show apps with this status to ticketer login
    case TICKET_CANCELLED = 'Ticket Cancelled'; // will be updated by the ticketer login
    case REFUND = 'Refund Requested'; // Refund Requested by ticketer login, need to show apps with this status to finance login
    case REFUNDED = 'Refunded'; // Refund Issued by Finance Team
}
