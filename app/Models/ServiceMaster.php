<?php

namespace App\Models;

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
}
