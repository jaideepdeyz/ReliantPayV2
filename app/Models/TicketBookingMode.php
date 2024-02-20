<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketBookingMode extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function saleBooking()
    {
        return $this->hasOne(SaleBooking::class, 'id', 'app_id');
    }

    public function flightBooking()
    {
        return $this->hasOne(FlightBooking::class, 'app_id', 'app_id');
    }

    public function amtrakBooking()
    {
        return $this->hasOne(AmtrakBooking::class, 'app_id', 'app_id');
    }
}
