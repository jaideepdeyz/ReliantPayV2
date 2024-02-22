<?php

namespace App\Livewire\Finance;

use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use Livewire\Component;
use Livewire\WithPagination;

class FianceDashboard extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;
    public $statusSearch;

    public function render()
    {
        $bookedSales = SaleBooking::when($this->search, function($query){
            $query->where('id', 'like', '%'.$this->search.'%')
            ->orWhere('customer_name', 'like', '%'.$this->search.'%')
            ->orWhere('customer_email', 'like', '%'.$this->search.'%')
            ->orWhere('customer_phone', 'like', '%'.$this->search.'%')
            ->orWhere('confirmation_number', 'like', '%'.$this->search.'%');
        })->when($this->statusSearch, function($query){
            $query->where('app_status', $this->statusSearch);
        })
        ->orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.finance.fiance-dashboard', [
            'bookedSales' => $bookedSales
        ])->layout('layouts.dashboard-layout');
    }
}
