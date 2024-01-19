<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function productsServices()
    {
        return $this->hasMany(OrganizationServiceMap::class, 'organization_id', 'id');
    }

    public function registrationUploads()
    {
        return $this->hasMany(RegistrationUpload::class, 'organization_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function transactionLogs()
    {
        return $this->hasMany(TransactionLog::class, 'organization_id', 'id');
    }

    public function scopeSearch($query, $value)
    {
        return $query->where('business_name', 'LIKE', "%{$value}%")
        ->orWhere('business_email', 'LIKE', "%{$value}%")
        ->orWhere('business_phone', 'LIKE', "%{$value}%")
        ->orWhere('business_address', 'LIKE', "%{$value}%")
        ->orWhere('status', 'LIKE', "%{$value}%");
    }

    public function supportDetails()
    {
        return $this->hasOne(SupportDetails::class, 'org_id', 'id');
    }

}
