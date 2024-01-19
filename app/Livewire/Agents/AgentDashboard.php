<?php

namespace App\Livewire\Agents;

use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use Livewire\Component;
use Auth;

class AgentDashboard extends Component
{
    public function render()
    {
        $authorizations = SaleBooking::where('agent_id', auth()->user()->id)->where('app_status', StatusEnum::AUTHORIZED->value)->latest()->take(5)->get();
        $bookings = SaleBooking::where('agent_id', auth()->user()->id)->latest()->take(5)->get();
        $customers = SaleBooking::where('agent_id', Auth::User()->id)->where('app_status',StatusEnum::PAYMENT_DONE->value)->count();
        $pendingPayment = SaleBooking::where('agent_id', Auth::User()->id)->where('app_status',StatusEnum::AUTHORIZED->value)->count();
        $pendingAuthorization = SaleBooking::where('agent_id', Auth::User()->id)->where('app_status',StatusEnum::PENDING->value)->count();
        $revenue = SaleBooking::where('agent_id', Auth::User()->id)
        ->where('app_status',StatusEnum::PAYMENT_DONE->value)
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
        return view('livewire.agents.agent-dashboard', compact('authorizations', 'bookings','customers','pendingPayment','pendingAuthorization','revenueThisMonth','revenueThisDay','revenueThisYear','revenueThisWeek'))->layout('layouts.dashboard-layout');
    }
}
