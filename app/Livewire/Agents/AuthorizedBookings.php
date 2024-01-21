<?php

namespace App\Livewire\Agents;

use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use Livewire\Component;
use Livewire\WithPagination;

class AuthorizedBookings extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;
    public $statusSearch;

    public function showDetails($appID)
    {
        return redirect()->route('airlineBooking.show', $appID);
    }

    public function render()
    {
        $sales = SaleBooking::where('agent_id', auth()->user()->id)
        ->whereIn('app_status', [StatusEnum::AUTHORIZED, StatusEnum::PAYMENT_DONE, StatusEnum::SENT_FOR_AUTH])
        ->when($this->search, function ($query) {
            $query->where('id', 'like', '%' . $this->search . '%')
            ->orWhere('customer_name', 'like', '%' . $this->search . '%')
            ->orWhere('customer_email', 'like', '%' . $this->search . '%')
            ->orWhere('customer_phone', 'like', '%' . $this->search . '%');
        })
        ->when($this->statusSearch, function ($query) {
            $query->where('app_status', $this->statusSearch);
        })->orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.agents.authorized-bookings', compact('sales'))->layout('layouts.dashboard-layout');
    }
}
