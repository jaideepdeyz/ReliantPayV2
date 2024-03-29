<?php

namespace App\Livewire\Admin;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ManageSales extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function render()
    {
        switch(Auth::User()->role)
        {
            case RoleEnum::ADMIN->value:
                $sales = SaleBooking::where('app_status', StatusEnum::PAYMENT_DONE->value)
                        ->when($this->search, function ($query) {
                            $query->where('customer_name', 'like', '%' . $this->search . '%')
                                ->orWhere('customer_email', 'like', '%' . $this->search . '%');
                        })
                        ->orderBy('updated_at', 'DESC')
                        ->paginate(10);
            break;
            case RoleEnum::DEALER->value:
            $sales = SaleBooking::where('organization_id', Auth::User()->organization_id)
                ->where('app_status', StatusEnum::PAYMENT_DONE->value)
                ->when($this->search, function ($query) {
                    $query->where('customer_name', 'like', '%' . $this->search . '%')
                        ->orWhere('customer_email', 'like', '%' . $this->search . '%');
                })
                ->orderBy('updated_at', 'DESC')
                ->paginate(10);
            break;
            case RoleEnum::AGENT->value:
            $sales = SaleBooking::where('agent_id', Auth::User()->id)
                ->where('app_status', StatusEnum::PAYMENT_DONE->value)
                ->when($this->search, function ($query) {
                    $query->where('customer_name', 'like', '%' . $this->search . '%')
                        ->orWhere('customer_email', 'like', '%' . $this->search . '%');
                })
                ->orderBy('updated_at', 'DESC')
                ->paginate(10);
            break;
            default:
             return redirect()->back();
        }
        
        return view('livewire.admin.manage-sales', [
            'sales' => $sales,
        ])->layout('layouts.dashboard-layout');
    }
}
