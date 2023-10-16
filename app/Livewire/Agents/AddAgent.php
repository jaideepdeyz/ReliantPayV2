<?php

namespace App\Livewire\Agents;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class AddAgent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[On('updatedAgent')]
    public function updatedAgent()
    {
        $this->render();
    }

    public function addAgent()
    {


        $this->dispatch('showModal', ['alias' => 'modals.add-user-modal', 'params' => ['orgID' => auth()->user()->organization_id]]);
    }

    public function render()
    {
        $agents = User::where('role', RoleEnum::AGENT->value)->where('organization_id', auth()->user()->organization_id)->get();
        return view('livewire.agents.add-agent', compact('agents'))->layout('layouts.dashboard-layout');
    }
}
