<?php

namespace App\Livewire\Dealer;

use App\Models\Organization;
use Livewire\Component;

class DealersByStatus extends Component
{
    public $status;

    public function mount($status)
    {
        $this->status = $status;
    }
    public function render()
    {
        $dealers = Organization::where('status', $this->status)->paginate(10);
        return view('livewire.dealer.dealers-by-status', compact('dealers'))->layout('layouts.dashboard-layout');
    }
}
