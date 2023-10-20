<?php

namespace App\Livewire\Agents;

use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use App\Models\ServiceMaster;
use App\Models\TransactionLog;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BookSales extends Component
{
    public $agent_name;
    public $service_id;
    public $customer_name;
    public $customer_phone;
    public $customer_email;
    public $sale;
    public $status;
    public $remarks;

    public function storeSaleBooking()
    {
        $this->validate([
            'service_id' => 'required',
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_email' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $this->sale = SaleBooking::create([
                'agent_id' => auth()->user()->id,
                'service_id' => $this->service_id,
                'customer_name' => $this->customer_name,
                'customer_phone' => $this->customer_phone,
                'customer_email' => $this->customer_email,
                'app_status' => StatusEnum::DRAFT,
            ]);
            $this->status = StatusEnum::DRAFT;
            $this->remarks = 'New Sale Added';
            $this->transactionLog();

            DB::commit();
            return redirect()->route('flightBooking', ['appID' => $this->sale->id]);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }

    }

    public function transactionLog()
    {
            TransactionLog::create([
                'organization_id' => auth()->user()->organization_id,
                'user_id' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
                'sales_id' => $this->sale->id,
                'type' => 'Sales',
                'status' => $this->status,
                'remarks' => $this->remarks,
            ]);
    }

    public function render()
    {
        $this->agent_name = auth()->user()->name;
        $services = ServiceMaster::all();
        return view('livewire.agents.book-sales', compact('services'))->layout('layouts.dashboard-layout');
    }
}
