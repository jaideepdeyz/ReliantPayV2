<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function booking()
    {
        return $this->hasOne(SaleBooking::class, 'id', 'app_id');
    }

    public function ticketBookingMode()
    {
        return $this->hasOne(TicketBookingMode::class, 'app_id', 'app_id');
    }
}
