<?php

namespace App\Livewire\Dealer;

use App\Enums\RoleEnum;
use App\Models\User;
use Livewire\Component;

class DealersByActivityStatus extends Component
{
    public $label;
    public $status;

    public function mount($status)
    {
        $this->status = $status;
        switch($status) {
            case 'Yes':
                $this->label = 'Active';
                break;
            case 'No':
                $this->label = 'Inactive';
                break;
        }
    }

    public function render()
    {
        $users = User::where('role', RoleEnum::DEALER->value)->where('is_active', $this->status)->paginate(10);
        return view('livewire.dealer.dealers-by-activity-status', compact('users'))->layout('layouts.dashboard-layout');
    }
}
