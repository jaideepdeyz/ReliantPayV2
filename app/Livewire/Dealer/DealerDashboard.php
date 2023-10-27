<?php

namespace App\Livewire\Dealer;

use Livewire\Component;

class DealerDashboard extends Component
{
    public function render()
    {
        return view('livewire.dealer.dealer-dashboard')->layout('layouts.dashboard-layout');
    }
}
