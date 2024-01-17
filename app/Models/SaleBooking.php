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
