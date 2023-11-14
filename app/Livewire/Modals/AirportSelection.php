<?php

namespace App\Livewire\Modals;

use App\Models\Airport;
use Livewire\Component;
use Livewire\WithPagination;

class AirportSelection extends Component
{
    public $countryID;
    public $type;
    public $search;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function mount($countryID, $type)
    {
        $this->countryID = $countryID;
        $this->type = $type;
    }

    public function selectAirport($airportID)
    {
        if($this->type == 'Departure')
        {
            $this->dispatch('hideModal');
            $this->dispatch('depAirport', $airportID);
        } else {
            $this->dispatch('hideModal');
            $this->dispatch('destAirport', $airportID);
        }
    }

    public function render()
    {
        $airports = Airport::when($this->search, function($query){
            $query->where('name', 'like', '%'.$this->search.'%');
        })
        ->where('iso_country', $this->countryID)
        ->paginate(5);
        return view('livewire.modals.airport-selection', compact('airports'));
    }
}
