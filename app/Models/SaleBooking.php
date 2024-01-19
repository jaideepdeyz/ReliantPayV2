<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleBooking extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded  = [];

    public function agent()
    {
        return $this->hasOne(User::class, 'id', 'agent_id');
    }

    public function service()
    {
        return $this->hasOne(ServiceMaster::class, 'id', 'service_id');
    }

    public function flightBooking()
    {
        return $this->hasOne(FlightBooking::class, 'app_id', 'id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'app_id', 'id');
    }

    public function totalPaymentsMonth()
    {
       //get sum of all payments from payments relation
        $totalPayments = $this->payment()->whereYear('updated_at',date('Y'))->whereMonth('updated_at',date('m'))->sum('amount_charged');
        return $totalPayments;
    }

    public function totalPaymentsYear()
    {
       //get sum of all payments from payments relation
        $totalPayments = $this->payment()->whereYear('updated_at',date('Y'))->sum('amount_charged');
        return $totalPayments;
    }

    public function totalPaymentsWeek()
    {
       //get sum of all payments from payments relation
        $totalPayments = $this->payment()->whereBetween('updated_at',[date('Y-m-d', strtotime('monday this week')),date('Y-m-d', strtotime('sunday this week'))])->sum('amount_charged');
        return $totalPayments;
    }

    public function totalPaymentsDay()
    {
       //get sum of all payments from payments relation
        $totalPayments = $this->payment()->whereDay('updated_at',date('d'))->sum('amount_charged');
        return $totalPayments;
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class, 'app_id', 'id');
    }

    public function authorizationForm()
    {
        return $this->hasOne(AuthorizationForm::class, 'app_id', 'id');
    }

    public function chargeDetails()
    {
        return $this->hasMany(ChargeDetails::class, 'app_id', 'id');
    }

}
