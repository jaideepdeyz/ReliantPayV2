<?php

namespace App\Livewire\Affilate;

use Livewire\Component;

class AffilateDashboard extends Component
{
    public function render()
    {
        return view('livewire.affilate.affilate-dashboard')->layout('layouts.dashboard-layout');
    }
}
