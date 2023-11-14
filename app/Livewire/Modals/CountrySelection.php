<?php

namespace App\Livewire\Modals;

use App\Models\Country;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class CountrySelection extends Component
{
    public $type;
    public $search;

    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount($type)
    {
        $this->type = $type;
    }
    public function selectCountry($code)
    {
        if ($this->type == 'Departure') {
            $this->dispatch('hideModal');
            $this->dispatch('depCountry', $code);
        } else {
            $this->dispatch('hideModal');
            $this->dispatch('destCountry', $code);
        }
    }
    public function render()
    {
        $countries = Country::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->orderByRaw("FIELD(code,'MX','CA','US') DESC,name ASC")->paginate(5);
        return view('livewire.modals.country-selection', compact('countries'));
    }
}
