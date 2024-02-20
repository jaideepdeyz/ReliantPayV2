<?php

namespace App\Livewire\Ticketer;

use App\Models\TicketBookingMode;
use Livewire\Component;
use Livewire\WithPagination;

class ManageTickets extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $confirmedBookings = TicketBookingMode::where('bookedThroughReservationAssistance', 'Yes')
        ->paginate(10);
        return view('livewire.ticketer.manage-tickets', [
            'confirmedBookings' => $confirmedBookings
        ])->layout('layouts.dashboard-layout');
    }
}
