<?php

namespace App\Livewire\Agents;

use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use Livewire\Component;
use Livewire\WithPagination;

class AuthorizedBookings extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function showDetails($appID)
    {
        return redirect()->route('airlineBooking.show', $appID);
    }

    public function render()
    {
        $sales = SaleBooking::where('agent_id', auth()->user()->id)->whereIn('app_status', [
            StatusEnum::AUTHORIZED->value,
            StatusEnum::SENT_FOR_AUTH->value,
            StatusEnum::PAYMENT_DONE->value,
        ])->latest()->paginate(10);
        return view('livewire.agents.authorized-bookings', compact('sales'))->layout('layouts.dashboard-layout');
    }
}
