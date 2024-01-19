<?php

namespace App\Livewire\Agents;

use App\Enums\StatusEnum;
use App\Models\Payment;
use App\Models\SaleBooking;
use Livewire\Component;
use Auth;

class AgentDashboard extends Component
{
    public function render()
    {
        $authorizations = SaleBooking::where('agent_id', auth()->user()->id)->where('app_status', StatusEnum::AUTHORIZED->value)->latest()->take(5)->get();
        $bookings = SaleBooking::where('agent_id', auth()->user()->id)->latest()->take(5)->get();
        $customers = SaleBooking::where('agent_id', Auth::User()->id)->where('app_status','Payment Done')->count();
        $pendingPayment = SaleBooking::where('agent_id', Auth::User()->id)->where('app_status','Authorized')->count();
        $pendingAuthorization = SaleBooking::where('agent_id', Auth::User()->id)->where('app_status','Pending')->count();
        $revenueThisMonth = Payment::with(['saleBooking',function($query){
            $query->where('agent_id', Auth::User()->id);
            $query->where('app_status', 'Payment Done');
        }])->whereMonth('created_at', date('m'))->sum('amount_charged');



        return view('livewire.agents.agent-dashboard', compact('authorizations', 'bookings','customers','pendingPayment','pendingAuthorization','revenueThi     sMonth'))->layout('layouts.dashboard-layout');
    }
}
