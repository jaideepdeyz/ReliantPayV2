<?php

namespace App\Livewire\Dealer;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PendingPayments extends Component
{
    public function render()
    {
        switch(Auth::User()->role)
        {
            case RoleEnum::DEALER->value:
                $pendingPayments = SaleBooking::where('organization_id', Auth::User()->organization_id)
                ->where('app_status', StatusEnum::AUTHORIZED->value)
                ->orderBy('updated_at', 'DESC')
                ->paginate(10);
                break;
            case RoleEnum::AGENT->value:
                $pendingPayments = SaleBooking::where('agent_id', Auth::User()->id)
                ->where('app_status', StatusEnum::AUTHORIZED->value)
                ->orderBy('updated_at', 'DESC')
                ->paginate(10);
                break;
            default:
                return redirect()->back();
        }
        return view('livewire.dealer.pending-payments', compact('pendingPayments'))->layout('layouts.dashboard-layout');
    }
}
