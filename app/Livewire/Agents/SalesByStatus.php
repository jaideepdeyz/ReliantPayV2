<?php

namespace App\Livewire\Agents;

use App\Enums\RoleEnum;
use App\Models\Sale;
use Livewire\Component;

class SalesByStatus extends Component
{
    public $status;


    public function mount($status)
    {
        $this->status = $status;
    }

    public function render()
    {
        $sales = Sale::where('role', RoleEnum::AGENT->value)->where('status', $this->status)->paginate(10);
        return view('livewire.agents.sales-by-status', compact('sales'))->layout('layouts.dashboard-layout');
    }
}
