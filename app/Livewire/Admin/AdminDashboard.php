<?php

namespace App\Livewire\Admin;

use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        $authorizations = SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)->latest()->take(5)->get();
        $bookings = SaleBooking::latest()->take(5)->get();
        $customers = SaleBooking::where('app_status',StatusEnum::PAYMENT_DONE->value)->count();
        $pendingPayment = SaleBooking::where('app_status',StatusEnum::AUTHORIZED->value)->count();
        $pendingAuthorization = SaleBooking::where('app_status',StatusEnum::PENDING->value)->count();
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
            'customers' => $customers,
            'pendingPayment' => $pendingPayment,
            'pendingAuthorization' => $pendingAuthorization,
            'revenueThisDay' => $revenueThisDay,
            'revenueThisWeek' => $revenueThisWeek,
            'revenueThisMonth' => $revenueThisMonth,
            'revenueThisYear' => $revenueThisYear,
            'revenueMonthly' => $revenueMonthly,
        ])->layout('layouts.dashboard-layout');
    }
}
