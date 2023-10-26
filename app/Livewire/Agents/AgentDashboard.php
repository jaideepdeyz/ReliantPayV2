<?php

namespace App\Livewire\Agents;

use Livewire\Component;

class AgentDashboard extends Component
{
    public function render()
    {
        return view('livewire.agents.agent-dashboard')->layout('layouts.dashboard-layout');
    }
}
