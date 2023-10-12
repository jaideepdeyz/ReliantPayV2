<?php

namespace App\Livewire\Dealer;

use App\Enums\StatusEnum;
use App\Models\Organization;
use Livewire\Component;
use Livewire\WithPagination;

class RegistrationApproval extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $dealers = Organization::where('status', StatusEnum::SUBMITTED->value)->paginate(10);
        return view('livewire.dealer.registration-approval', compact('dealers'))->layout('layouts.dashboard-layout');
    }
}
