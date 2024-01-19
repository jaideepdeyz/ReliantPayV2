<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportDetails extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function org()
    {
        return $this->hasOne(Organization::class, 'id', 'org_id');
    }
}
