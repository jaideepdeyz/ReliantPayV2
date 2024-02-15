<?php

namespace App\Livewire\Ticketer;

use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use Livewire\Component;

class ManageTickets extends Component
{
    public function render()
    {
        $confirmedBookings = SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)
        ->paginate(10);
        return view('livewire.ticketer.manage-tickets', [
            'confirmedBookings' => $confirmedBookings
        ])->layout('layouts.dashboard-layout');
    }
}
