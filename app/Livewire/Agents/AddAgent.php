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

    #[Url(history::true)]
    public $search = '';

    #[Url(history::true)]
    public $perPage = 10;

    #[Url(history::true)]
    public $sortBy = 'created_at';

    #[Url(history::true)]
    public $sortDirection = 'desc';

    public function setSortBy($sortColumn)
    {
        Log::info('Entered Sort By in Admin Countries Listing for sorting by ' . $sortColumn);


        if ($this->sortBy  === $sortColumn) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortBy = $sortColumn;
    }

    // protected $paginationTheme = 'bootstrap';

    #[On('updatedAgent')]
    public function updatedAgent()
    {
        $this->render();
    }

    public function addAgent()
    {
        $this->dispatch('showModal', ['alias' => 'modals.add-user-modal', 'params' => ['orgID' => auth()->user()->organization_id]]);
    }

    public function activateDeactivate($id)
    {
        $user = User::find($id);
        if($user->is_active == 'Yes')
        {
             $user->update(['is_active' => 'No']);
            $this->dispatch('message', heading:'success',text:'Agent deactivated')->self();
        }else{
            $user->update(['is_active' => 'Yes']);
            $this->dispatch('message', heading:'success',text:'Agent activated')->self();
        }
    }

    public function render()
    {
        $agents = User::where('role', RoleEnum::AGENT->value)
                    ->where('organization_id', auth()->user()->organization_id)
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage);
        return view('livewire.agents.add-agent', compact('agents'))->layout('layouts.dashboard-layout');
    }
}
