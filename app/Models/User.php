<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'organization_id',
        'is_active',
        'is_approved',
        'phone_number',
        'country_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function organization()
    {
        return $this->hasOne(Organization::class, 'id', 'organization_id');
    }

    public function agentActivity()
    {
        return $this->hasMany(SaleBooking::class, 'agent_id', 'id')->where('app_status', StatusEnum::PAYMENT_DONE->value);
    }

    public function totalAgentRevenue()
    {
       //get sum of all payments from booking relation
        $totalAgentRevenue = $this->agentActivity()->sum('amount_charged');
        return $totalAgentRevenue;
    }

    public function transactionLogs()
    {
        return $this->hasMany(TransactionLog::class, 'user_id', 'id');
    }

    public function agentPasswordChangeLogs()
    {
        return $this->hasOne(AgentPasswordChangeLogs::class, 'user_id', 'id');
    }

    public function merchantPasswordChangeLogs()
    {
        return $this->hasOne(MerchantPasswordChangeLogs::class, 'user_id', 'id');
    }

    public function affiliate()
    {
        return $this->hasOne(Affiliate::class, 'user_id', 'id');
    }
}
