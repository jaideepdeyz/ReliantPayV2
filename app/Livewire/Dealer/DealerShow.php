<?php

namespace App\Livewire\Dealer;

use App\Models\Organization;
use Livewire\Component;

class DealerShow extends Component
{
    public $orgID;
    public function render()
    {
        $org = Organization::find($this->orgID);
        return view('livewire.dealer.dealer-show',[
            'org' => $org
        ])->layout('layouts.dashboard-layout');
    }
}
