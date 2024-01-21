<?php

namespace App\Livewire\Admin;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use App\Models\User;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        $authorizations = SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)->latest()->take(5)->get();
        $bookings = SaleBooking::latest()->take(5)->get();
        $agents = User::where('role', RoleEnum::AGENT->value)->count();
        $dealers = User::where('role',RoleEnum::DEALER->value)->count();
        $pendingRegistrations = User::where('role',RoleEnum::DEALER->value)->whereIn('is_approved', ['No', null])->where('organization_id', '!=', NULL)->count();
        $revenue = SaleBooking::where('app_status',StatusEnum::PAYMENT_DONE->value)
        ->whereYear('updated_at',date('Y'))
        ->get();
        $revenueThisDay= 0;
        $revenueThisWeek= 0;
        $revenueThisMonth = 0;
        $revenueThisYear = 0;
        $revenueMonthly=0;
        $inc = 1;
        foreach($revenue as $rev){
            $revenueThisDay += $rev->totalPaymentsDay();
            $revenueThisMonth += $rev->totalPaymentsMonth();
            $revenueThisYear += $rev->totalPaymentsYear();
            $revenueThisWeek += $rev->totalPaymentsWeek();
            $revenueMonthly += $rev->totalPaymentsMonthly('02');
            $inc++;
        }
        return view('livewire.admin.admin-dashboard', [
            'authorizations' => $authorizations,
            'bookings' => $bookings,
            'agents' => $agents,
            'dealers' => $dealers,
            'pendingRegistrations' => $pendingRegistrations,
            'revenueThisDay' => $revenueThisDay,
            'revenueThisWeek' => $revenueThisWeek,
            'revenueThisMonth' => $revenueThisMonth,
            'revenueThisYear' => $revenueThisYear,
            'revenueMonthly' => $revenueMonthly,
        ])->layout('layouts.dashboard-layout');
    }
}
