<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerMaster extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function saleBooking()
    {
        return $this->hasMany(SaleBooking::class, 'customer_id', 'id');
    }
}
