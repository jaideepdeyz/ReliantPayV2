<?php

namespace App\Livewire\Dealer;

use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use Livewire\Component;

class DealerDashboard extends Component
{
    public function render()
    {
        return view('livewire.dealer.dealer-dashboard')->layout('layouts.dashboard-layout');
    }
}
