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

}
