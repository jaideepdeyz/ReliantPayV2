<?php

namespace App\Livewire\Dealer;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ManageCustomers extends Component
{
    public $search = '';
    
    public function render()
    {
        switch(Auth::User()->role)
        {
            case RoleEnum::DEALER->value: 
                $customers = SaleBooking::where('organization_id', Auth::User()->organization_id)
                ->where('app_status', StatusEnum::PAYMENT_DONE->value)
                ->when($this->search, function ($query) {
                    $query->where('customer_name', 'like', '%' . $this->search . '%')
                        ->orWhere('customer_email', 'like', '%' . $this->search . '%');
                })
                ->orderBy('updated_at', 'DESC')
                ->paginate(10);
            break;
            case RoleEnum::AGENT->value:
                $customers = SaleBooking::where('agent_id', Auth::User()->id)
                    ->where('app_status', StatusEnum::PAYMENT_DONE->value)
                    ->when($this->search, function ($query) {
                        $query->where('customer_name', 'like', '%' . $this->search . '%')
                            ->orWhere('customer_email', 'like', '%' . $this->search . '%');
                    })
                    ->orderBy('updated_at', 'DESC')
                    ->paginate(10);
            default:
            $customers =  SaleBooking::where('agent_id', Auth::User()->id)->where('app_status', StatusEnum::PAYMENT_DONE->value)->paginate(10);
        }
        return view('livewire.dealer.manage-customers', [
            'customers' => $customers,
        ])->layout('layouts.dashboard-layout');
    }
}
