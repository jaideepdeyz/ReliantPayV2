<?php

namespace App\Livewire\Agents;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class AddAgent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function addAgent()
    {
        // $this->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email',
        //     // 'phone' => 'required|numeric|unique:users,phone',
        //     'password' => 'required|min:6',
        // ]);

        // User::create([
        //     'name' => $this->name,
        //     'email' => $this->email,
        //     'phone' => $this->phone,
        //     'organization_id' => auth()->user()->organization_id,
        //     'role' => RoleEnum::AGENT->value,
        //     'password' => Hash::make('agent#123'),
        // ]);

        // $this->reset();
        // $this->render();

        $this->dispatch('showModal', ['alias' => 'modals.add-user-modal', 'params' => ['orgID' => auth()->user()->organization_id]]);
    }

    public function render()
    {
        $agents = User::where('role', RoleEnum::AGENT->value)->where('organization_id', auth()->user()->organization_id)->get();
        return view('livewire.agents.add-agent', compact('agents'))->layout('layouts.dashboard-layout');
    }
}
