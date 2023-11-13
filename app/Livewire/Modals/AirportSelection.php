<?php

namespace App\Livewire\Modals;

use App\Models\Airport;
use Livewire\Component;

class AirportSelection extends Component
{
    public $countryID;

    public function mount($countryID)
    {
        $this->countryID = $countryID;
    }

    public function render()
    {
        $airports = Airport::where('iso_country', $this->countryID)->get();
        return view('livewire.modals.airport-selection', compact('airports'));
    }
}
