<?php

namespace App\Livewire\Agents;

use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use Livewire\Component;

class AgentDashboard extends Component
{
    public function render()
    {
        $authorizations = SaleBooking::where('agent_id', auth()->user()->id)->where('app_status', StatusEnum::AUTHORIZED->value)->latest()->take(5)->get();
        $bookings = SaleBooking::where('agent_id', auth()->user()->id)->latest()->take(5)->get();
        return view('livewire.agents.agent-dashboard', compact('authorizations', 'bookings'))->layout('layouts.dashboard-layout');
    }
}
