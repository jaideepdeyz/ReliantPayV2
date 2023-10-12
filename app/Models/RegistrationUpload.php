<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistrationUpload extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function organization()
    {
        return $this->hasOne(Organization::class, 'id', 'organization_id');
    }
}
