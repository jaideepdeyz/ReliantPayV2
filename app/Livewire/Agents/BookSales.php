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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class BookSales extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $agent_name;
    // public $service_id;
    public $serviceName;
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
    public $relationship_to_card_holder;
    public $sale_type;

    #[On('operationCompleted')]
    public function operationCompleted()
    {
        $this->render();
        $this->dispatch('reRender');
    }

    public function paginationView()
    {
        return 'livewire.util.pagination';
    }

    public function storeSaleBooking()
    {
        $this->validate([
            'serviceName' => 'required',
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_email' => 'required',
            'customer_dob' => 'required',
            'customer_gender' => 'required',
            'relationship_to_card_holder' => 'required',
            'sale_type' => 'required',
        ], [
            'serviceName.required' => 'Service is required',
            'customer_name.required' => 'Customer Name is required',
            'customer_phone.required' => 'Customer Phone is required',
            'customer_email.required' => 'Customer Email is required',
            'customer_dob.required' => 'Customer Date of Birth is required',
            'customer_gender.required' => 'Customer Gender is required',
            'relationship_to_card_holder.required' => 'Relationship to Card Holder is required',
            'sale_type.required' => 'Sale Type is required',
        ]);

        try {
            DB::beginTransaction();

            //checking uniqueness of customer email
            $customer = CustomerMaster::where('customer_email', $this->customer_email)->first();
            if(!$customer)
            {
                $customer = CustomerMaster::create([
                    'customer_email' => $this->customer_email,
                    'customer_name' => $this->customer_name,
                    'customer_gender' => $this->customer_gender,
                    'customer_dob' => $this->customer_dob,
                ]);
            }


            // getting the service id from services table

            $service = ServiceMaster::where('service_name', $this->serviceName)->first();

            $this->sale = SaleBooking::create([
                'agent_id' => auth()->user()->id,
                'organization_id' => auth()->user()->organization_id,
                'service_id' => $service->id,
                'sale_type' => $this->sale_type,
                'customer_id' => $customer->id,
                'customer_name' => $this->customer_name,
                'customer_gender' => $this->customer_gender,
                'customer_dob' => $this->customer_dob,
                'customer_email' => $this->customer_email,
                'customer_phone' => $this->customer_phone,
                'app_status' => StatusEnum::DRAFT,
                'relationship_to_card_holder' => $this->relationship_to_card_holder,
            ]);
            $this->status = StatusEnum::DRAFT;
            $this->remarks = 'New Sale Added';
            $this->transactionLog();

            DB::commit();
            $this->reset(['serviceName', 'sale_type', 'customer_name', 'customer_phone', 'customer_email', 'customer_dob', 'customer_gender']);
            $this->dispatch('close-modal');

            if($this->sale_type == 'Cancellation')
            {
                $this->dispatch('message', heading:'success',text:'Cancellation Created')->self();
                return redirect()->route('cancelBookingExternalCustomer', ['appID' => $this->sale->id]);
            }

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
        $services = OrganizationServiceMap::where('organization_id', auth()->user()->organization_id)
        ->where('service_status', 'Activated')
        ->get();

        $bookedSales = SaleBooking::where('agent_id', auth()->user()->id)
        ->when($this->search, function($query){
            $query->where('id', 'like', '%'.$this->search.'%')
            ->orWhere('customer_name', 'like', '%'.$this->search.'%')
            ->orWhere('customer_email', 'like', '%'.$this->search.'%')
            ->orWhere('customer_phone', 'like', '%'.$this->search.'%')
            ->orWhere('confirmation_number', 'like', '%'.$this->search.'%');
        })->when($this->statusSearch, function($query){
            $query->where('app_status', $this->statusSearch);
        })->orderBy('created_at', 'DESC')->paginate(10);

        return view('livewire.agents.book-sales', compact('services', 'bookedSales'))->layout('layouts.dashboard-layout');
    }
}
