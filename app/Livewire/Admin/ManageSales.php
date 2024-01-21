<?php

namespace App\Livewire\Admin;

use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ManageSales extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function render()
    {
        $sales = SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)
        ->whereYear('updated_at', Carbon::now()->year)
        ->whereMonth('updated_at', Carbon::now()->month)
        ->when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        })
        ->orderBy('updated_at', 'DESC')
        ->paginate(10);
        return view('livewire.admin.manage-sales', [
            'sales' => $sales,
        ])->layout('layouts.dashboard-layout');
    }
}
