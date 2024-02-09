<?php

namespace App\Livewire\Agents;

use App\Enums\ServiceEnum;
use App\Enums\StatusEnum;
use App\Models\CustomerMaster;
use App\Models\FlightBooking;
use App\Models\OrganizationServiceMap;
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
    public $statusSearch;
    public $selectedID;
    public $customer_dob;
    public $customer_gender;

    public function storeSaleBooking()
    {
        $this->validate([
            'service_id' => 'required',
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_email' => 'required',
            'customer_dob' => 'required',
            'customer_gender' => 'required',
        ]);

        try {
            DB::beginTransaction();

            //checking uniqueness of customer email
            $customer = CustomerMaster::where('customer_email', $this->customer_email)->first();
            if(!$customer)
            {
                $customer = CustomerMaster::create(
                    [
                    'customer_email' => $this->customer_email,
                    'customer_name' => $this->customer_name,
                    'customer_gender' => $this->customer_gender,
                    'customer_dob' => $this->customer_dob
                ]);
            }

            $this->sale = SaleBooking::create([
                'agent_id' => auth()->user()->id,
                'organization_id' => auth()->user()->organization_id,
                'service_id' => $this->service_id,
                'customer_id' => $customer->id,
                'customer_phone' => $this->customer_phone,
                'app_status' => StatusEnum::DRAFT,
            ]);
            $this->status = StatusEnum::DRAFT;
            $this->remarks = 'New Sale Added';
            $this->transactionLog();

            DB::commit();
            $this->reset(['service_id', 'customer_name', 'customer_phone', 'customer_email', 'customer_dob', 'customer_gender']);
            $this->dispatch('close-modal');
            $this->dispatch('message', heading:'success',text:'Booking Created')->self();
            switch($this->sale->service->service_name)
            {
                case ServiceEnum::FLIGHTS->value:
                    return redirect()->route('flightBooking', ['appID' => $this->sale->id]);
                case ServiceEnum::AMTRAK->value:
                    return redirect()->route('amtrakBooking', ['appID' => $this->sale->id]);
                default:
                    return redirect()->back();
            }
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }

    }

    public function selectId($id)
    {
        $this->selectedID = $id;
    }

    public function viewBooking($bookingID)
    {
        // dd($bookingID);
        $booking = SaleBooking::find($bookingID);
        switch($booking->service->service_name)
        {
            case ServiceEnum::FLIGHTS->value:
                return redirect()->route('flightBooking', ['appID' => $bookingID]);
            case ServiceEnum::AMTRAK->value:
                return redirect()->route('amtrakBooking', ['appID' => $bookingID]);
            default:
                return redirect()->back();
        }
    }

    public function deleteSaleBooking()
    {

        $this->sale = SaleBooking::find($this->selectedID);
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
            $this->reset('selectedID');
            $this->dispatch('message', heading:'success',text:'Booking deleted')->to(AgentDashboard::class);
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
        // $services = ServiceMaster::all();
        $services = OrganizationServiceMap::where('organization_id', auth()->user()->organization_id)
        ->where('service_status', 'Activated')
        ->get();

        $bookedSales = SaleBooking::where('agent_id', auth()->user()->id)
        ->whereIn('app_status', [
            StatusEnum::DRAFT->value,
            StatusEnum::PENDING->value,
            // StatusEnum::PAYMENT_DONE->value,
            ])
        ->when($this->search, function($query){
            $query->where('id', 'like', '%'.$this->search.'%')
            ->orWhere('customer_name', 'like', '%'.$this->search.'%')
            ->orWhere('customer_email', 'like', '%'.$this->search.'%')
            ->orWhere('customer_phone', 'like', '%'.$this->search.'%');
        })->when($this->statusSearch, function($query){
            $query->where('app_status', $this->statusSearch);
        })
        // ->where('app_status', StatusEnum::DRAFT->value)
        // ->where('app_status', StatusEnum::PENDING->value)
        ->orderBy('created_at', 'DESC')->paginate(10);

        return view('livewire.agents.book-sales', compact('services', 'bookedSales'))->layout('layouts.dashboard-layout');
    }
}
