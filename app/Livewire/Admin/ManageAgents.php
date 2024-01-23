<?php

namespace App\Livewire\Admin;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Livewire\Attributes\Url;
use Livewire\Component;

class ManageAgents extends Component
{
    #[Url(history::true)]
    public $search = '';

    #[Url(history::true)]
    public $perPage = 10;

    #[Url(history::true)]
    public $sortBy = 'created_at';

    #[Url(history::true)]
    public $sortDirection = 'desc';

    public $user;

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

    public function activateDeactivate($id)
    {
        $this->user = User::find($id);
        if($this->user->is_active == 'Yes')
        {
            $this->user->update([
                'is_active' => 'No'
            ]);
        }else{
            $this->user->update([
                'is_active' => 'Yes'
            ]);
        }
    }

    public function render()
    {
        switch(Auth::User()->role)
        {
            case RoleEnum::ADMIN->value:
                $agents = User::where('role', RoleEnum::AGENT->value)
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                })
                ->paginate(10);
            break;
            case RoleEnum::DEALER->value:
            $agents = User::where('organization_id', Auth::User()->organization_id)
                ->where('role', RoleEnum::AGENT->value)
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                })
                ->paginate(10);
            break;
            default:
             return redirect()->back();
        }
        
        return view('livewire.admin.manage-agents', [
            'agents' => $agents,
        ])->layout('layouts.dashboard-layout');
    }
}
