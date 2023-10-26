<?php

namespace App\Livewire\Agents;

use App\Enums\ServiceEnum;
use App\Enums\StatusEnum;
use App\Models\FlightBooking;
use App\Models\Payment;
use App\Models\SaleBooking;
use App\Models\ServiceMaster;
use App\Models\TransactionLog;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class BookSales extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $agent_name;
    public $service_id;
    public $customer_name;
    public $customer_phone;
    public $customer_email;
    public $sale;
    public $status;
    public $remarks;
    public $search;

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

            //creating entry in Flight, Passengers and Payments table
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }

    }

    public function viewBooking($bookingID)
    {
        // dd($bookingID);
        $booking = SaleBooking::find($bookingID);
        switch($booking->service->service_name)
        {
            case ServiceEnum::FLIGHTS->value:
                return redirect()->route('flightBooking', ['appID' => $bookingID]);
                break;
            default:
                    return redirect()->back();
                    break;
        }
    }

    public function deleteSaleBooking($appID)
    {

        $this->sale = SaleBooking::find($appID);
        try {
            DB::beginTransaction();
            $this->sale->flightBooking()->delete();
            $this->sale->payment()->delete();
            $this->sale->passengers()->delete();
            $this->sale->delete();

            $this->status = StatusEnum::DELETED;
            $this->remarks = 'Sale Deleted';
            $this->transactionLog();

            DB::commit();
            return redirect()->back();

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
        $bookedSales = SaleBooking::where('agent_id', auth()->user()->id)
        ->when($this->search, function($query){
            $query->where('id', 'like', '%'.$this->search.'%');
        })->orWhere('customer_name', 'like', '%'.$this->search.'%')
        ->orWhere('customer_email', 'like', '%'.$this->search.'%')
        ->orWhere('app_status', 'like', '%'.$this->search.'%')
        ->orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.agents.book-sales', compact('services', 'bookedSales'));
    }
}
