<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceMaster extends Model
{
    use HasFactory;

    protected $guarded  = [];

    public function booking()
    {
        return $this->hasMany(SaleBooking::class, 'service_id', 'id');
    }

    public function successBooking()
    {
        return $this->hasMany(SaleBooking::class, 'service_id', 'id')->whereIn('app_status', [StatusEnum::PAYMENT_DONE->value, StatusEnum::TICKET_ISSUED->value]);
    }

    public function successBookingByMerchant()
    {
        return $this->hasMany(SaleBooking::class, 'service_id', 'id')->whereIn('app_status', [StatusEnum::PAYMENT_DONE->value, StatusEnum::TICKET_ISSUED->value])->where('organization_id', auth()->user()->organization_id);
    }

    public function totalRevenue()
    {
       //get sum of all payments from booking relation
        $totalRevenue = $this->successBooking()->sum('amount_charged');
        return $totalRevenue;
    }

    public function totalRevenueByMerchant()
    {
       //get sum of all payments from booking relation
        $totalRevenue = $this->successBookingByMerchant()->sum('amount_charged');
        return $totalRevenue;
    }


}
