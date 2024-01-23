<?php

namespace App\Livewire\Dealer;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PendingAuthorization extends Component
{
    public function render()
    {
        switch(Auth::User()->role)
        {
            case RoleEnum::DEALER->value: 
                $pendingAuths = SaleBooking::where('organization_id', Auth::User()->organization_id)
                ->where('app_status', StatusEnum::SENT_FOR_AUTH->value)
                ->orderBy('updated_at', 'DESC')
                ->paginate(10);
                break;
            case RoleEnum::AGENT->value:
                $pendingAuths = SaleBooking::where('agent_id', Auth::User()->id)
                ->where('app_status', StatusEnum::SENT_FOR_AUTH->value)
                ->orderBy('updated_at', 'DESC')
                ->paginate(10);
                break;
            default:
                return redirect()->back();
        }
        
        return view('livewire.dealer.pending-authorization', [
            'pendingAuths' => $pendingAuths
        ])->layout('layouts.dashboard-layout');
    }
}
