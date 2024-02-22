<?php

namespace App\Livewire\Admin;

use App\Enums\RoleEnum;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUsers extends Component
{
    use WithPagination;

    #[On('operationComplete')]
    public function updatedAgent()
    {
        $this->render();
    }

    public function render()
    {
        $users = User::whereIn('role', [
            RoleEnum::ADMIN->value,
            RoleEnum::AFFILIATE->value,
            RoleEnum::FINANCE->value,
            RoleEnum::TICKETER->value,
        ])->paginate(10);

        return view('livewire.admin.manage-users', [
            'users' => $users
        ])->layout('layouts.dashboard-layout');
    }
}
