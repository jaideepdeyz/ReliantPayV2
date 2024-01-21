<?php

namespace App\Livewire\Admin;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\Organization;
use App\Models\SaleBooking;
use App\Models\ServiceMaster;
use App\Models\User;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $processes=[];
    public $merchants=[];

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

        $availableServices = ServiceMaster::all();
        foreach($availableServices as $service)
        {
            //store total revenue for each service
            $processes = [
                'service' => $service->service_name,
                'totalRevenue' => $service->totalRevenue(),
            ];
            array_push($this->processes, $processes);
        }

        $availableMerchants = Organization::where('status', 'Approved')->get();
        foreach($availableMerchants as $merchant)
        {
            //store total revenue for each service
            $merchant = [
                'merchant' => $merchant->business_name,
                'totalMerchRevenue' => $merchant->totalMerchantRevenue(),
            ];
            array_push($this->merchants, $merchant);
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
            'processes' => $this->processes,
            'merchants' => $this->merchants,
        ])->layout('layouts.dashboard-layout');
    }
}
