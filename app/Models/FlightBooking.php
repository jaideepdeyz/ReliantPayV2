<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlightBooking extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function booking()
    {
        return $this->hasOne(SaleBooking::class, 'id', 'app_id');
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class, 'app_id', 'app_id');
    }

    public function departureAirport()
    {
        return $this->hasOne(Airport::class, 'id', 'departure_location');
    }

    public function destinationAirport()
    {
        return $this->hasOne(Airport::class, 'id', 'destination_location');
    }

    public function itenary()
    {
        return $this->hasOne(TravelItenaryUpload::class, 'app_id', 'app_id');
    }
}
