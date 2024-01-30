<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfirmedTicket extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function saleBooking()
    {
        return $this->hasOne(SaleBooking::class, 'id', 'sale_booking_id');
    }
}
